<?php

namespace App\Http\Controllers;

use App\Boxes;
use App\Cells;
use App\Http\Requests\CreateFolderInCellRequest;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\StoreCellRequest;
use Illuminate\Support\Facades\Session;

class CellsController extends Controller
{


    public function update(StoreCellRequest $request, $id)
    {
        $cell = Cells::findOrFail($id);
        if ($request->validated()) {
            $cell->update($request->all());
            return redirect()->route('boxes.show',$cell->box->id)->with('success', 'Ячейка "' . $cell->title . '" успешно обновлена.');
        }
    }

    public function show($id)
    {
        $cell = Cells::with('folders.documents')->findOrFail($id);
        return view('cells.show', [
            'cell' => $cell
        ]);
    }

    public function edit($id)
    {
        $cell = Cells::findOrFail($id);
        return view('cells.edit', [
            'cell' => $cell
        ]);
    }

    public function destroy($id)
    {
        $cell = Cells::findOrFail($id);
        try{
            $cell->delete();
            return redirect()->route('boxes.show',$cell->box_id)->with('success',
                'Ячейка "' . $cell->title . '" успешно удалена из Шкафа "' . $cell->box->title . '"');
        }catch (\DomainException $e){
            return redirect()->back()->with('warning', $e->getMessage());
        }
    }

    public function create_cell($id)
    {
        $box = Boxes::findOrFail($id);
        return view('boxes.create_cell', [
            'box' => $box
        ]);
    }

    public function store_cell(StoreCellRequest $request, $id)
    {
        $box = Boxes::findOrFail($id);
        if ($request->validated()) {
            try {
                $cell = $box->createCell($request);
                return redirect()->back()
                    ->with('success',
                        'Создана новая ячейка с именем "' . $cell->title . '" в Шкафу "' . $box->title . '"');
            } catch (\DomainException $e) {
                return redirect()->back()->with('warning', $e->getMessage());
            }
        }
    }

    public function create_folder($id)
    {
        $cell = Cells::findOrFail($id);
        return view('cells.create_folder',[
            'cell'=>$cell
        ]);
    }

    public function store_folder(CreateFolderInCellRequest $request, $id)
    {
        $cell = Cells::findOrFail($id);
        if($request->validated()){
            $cell->createFolder($request);
            return redirect()->route('cells.show', ['id' => $cell->id])
                ->with('success',
                    'Создана новая папка в ячейке "' . $cell->title . '"');
        }
        return view('cells.create_folder');
    }
}
