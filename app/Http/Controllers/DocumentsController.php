<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Folders;
use App\Http\Requests\StoreDocumentRequest;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::all();
        return view('documents.index', [
            'documents' => $documents
        ]);
    }

    public function show($id)
    {
        $document = Documents::with(['folder.cell.box.workplace'])->findOrFail($id);
        return view('documents.show', [
            'document' => $document
        ]);
    }

    public function create()
    {
        $folders = Folders::pluck('title', 'id');
        return view('documents.create', [
            'folders' => $folders
        ]);
    }

    public function edit($id)
    {
        $document = Documents::findOrFail($id);
        $folders = Folders::pluck('title', 'id');
        return view('documents.edit', [
            'document' => $document,
            'folders' => $folders
        ]);
    }


    public function update(StoreDocumentRequest $request, $id)
    {
        $document = Documents::query()->findOrFail($id);
        if ($request->validated()) {
            $document->update($request->all());
            return redirect(route('documents.index'))->with('success', 'Документ успешно обновлен');
        }
    }

    public function store(StoreDocumentRequest $request)
    {
        if ($request->validated()) {
            try {
                Documents::create($request->all());
                return redirect()->back()->with('success', 'Документ успешно создан');
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
    public function destroy($id)
    {
        $document = Documents::findOrFail($id);
        $response = redirect();
        if($document->folder){
            $response = $response->route('folders.show',$document->folder->id);
        }else{
            $response = $response->route('documents.index');
        }
        $document->delete();
        return $response->with('success',
            'Документ "' . $document->title . '" успешно удален.');
    }
}
