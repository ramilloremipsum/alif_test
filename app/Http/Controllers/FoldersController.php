<?php

namespace App\Http\Controllers;


use App\Boxes;
use App\Cells;
use App\Folders;
use App\Http\Requests\CreateDocumentInFolderRequest;
use App\Http\Requests\StoreFolderRequest;
use App\Workplaces;

class FoldersController extends Controller
{
    public function index()
    {
        $folders = Folders::with(['cell.box.workplace', 'documents'])->get();
        return view('folders.index', [
            'folders' => $folders
        ]);
    }

    public function create()
    {
        return view('folders.create');
    }

    public function show($id)
    {
        $folder = Folders::with('cell.box.workplace')->findOrFail($id);
        return view('folders.show', [
            'folder' => $folder
        ]);
    }

    public function edit($id)
    {
        $folder = Folders::query()->findOrFail($id);
        return view('folders.edit', [
            'folder' => $folder
        ]);
    }

    public function update(StoreFolderRequest $request, $id)
    {
        $folder = Folders::query()->findOrFail($id);
        if ($request->validated()) {
            $folder->update($request->all());
            return redirect()->back()->with('success', 'Папка успешно обновлена');
        }
    }

    public function store(StoreFolderRequest $request)
    {
        if ($request->validated()) {
            try {
                Folders::create($request->all());
                return redirect()->back()->with('success', 'Папка успешно создана');
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }

    public function create_document($id)
    {
        $folder = Folders::findOrFail($id);
        return view('folders.create_document', [
            'folder' => $folder
        ]);
    }

    public function store_document(CreateDocumentInFolderRequest $request, $id)
    {
        $folder = Folders::findOrFail($id);
        if ($request->validated()) {
            $document = $folder->createDocument($request);
            return redirect()->route('folders.show', ['id' => $folder->id])
                ->with('success',
                    'Документ "' . $document->title . '" успешно создан в папке "' . $folder->title . '"');
        }
        return view('folders.create_document', [
            'folder' => $folder
        ]);
    }


    public function destroy($id)
    {
        $folder = Folders::find($id);
        $folder->delete();
        return redirect()->route('cells.show', $folder->cell_id)->with('success',
            'Папка "' . $folder->title . '" успешно удалена.');
    }

    public function get_boxes($id)
    {
        $boxes = Boxes::query()->where('workplace_id', '=', $id)->pluck('title', 'id');
        return json_encode($boxes);
    }

    public function get_cells($id)
    {
        $cells = Cells::query()->where('box_id', '=', $id)->pluck('title', 'id');
        return json_encode($cells);
    }

    public function get_workplaces()
    {
        $workplaces = Workplaces::all()->pluck('title', 'id');
        return json_encode($workplaces);
    }
}
