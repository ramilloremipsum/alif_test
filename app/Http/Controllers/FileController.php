<?php

namespace App\Http\Controllers;

use App\Files;
use App\Folders;
use App\Helpers\Amate;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;

class FileController extends Controller
{
    public function index()
    {
        $files = Files::all();
        return view('file.index', [
            'files' => $files
        ]);
    }

    public function show($id)
    {
        $file = Files::with(['folder.cell.box.workplace'])->findOrFail($id);
        return view('file.show', [
            'file' => $file
        ]);
    }

    public function create()
    {
        $folders = Folders::pluck('title', 'id');
        return view('file.create', [
            'folders' => $folders
        ]);
    }

    public function edit($id)
    {
        $file = Files::findOrFail($id);
        $folders = Folders::pluck('title', 'id');
        return view('file.edit', [
            'file' => $file,
            'folders' => $folders
        ]);
    }


    public function update(UpdateFileRequest $request, $id)
    {
        $file = Files::query()->findOrFail($id);
        if ($request->validated()) {
            $file->update($request->all());
            return redirect(route('file.index'))->with('success', 'Файл успешно обновлен');
        }
    }

    public function store(StoreFileRequest $request)
    {
        if ($request->validated()) {
            try {
                $file = Files::createFile($request);
                return redirect()->back()->with('success', 'Файл успешно создан');
            } catch (\DomainException $e) {
                return redirect()->back()->with('warning', $e->getMessage());
            }
        }
    }
    public function destroy($id)
    {
        $file = Files::findOrFail($id);
        $response = redirect();
        if($file->folder){
            $response = $response->route('folders.show',$file->folder->id);
        }else{
            $response = $response->route('file.index');
        }
        $file->deleteFile();
        return $response->with('success',
            'Файл "' . $file->title . '" успешно удален.');
    }
}
