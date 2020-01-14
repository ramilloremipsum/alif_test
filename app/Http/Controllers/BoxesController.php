<?php

namespace App\Http\Controllers;

use App\Boxes;
use App\Exceptions\BoxAlreadyExistsInWorkplace;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\StoreCellRequest;
use Illuminate\Support\Facades\Session;

class BoxesController extends Controller
{


    public function update(StoreBoxRequest $request, $id)
    {
        $box = Boxes::findOrFail($id);
        if ($request->validated()) {
            try {
                $box->update($request->all());
            } catch (\DomainException $e) {
                return redirect()->back()->with('warning', $e->getMessage());
            }
            return redirect()->back()->with('success', 'Шкаф "' . $box->title . '" успешно обновлено');
        }
    }

    public function show($id)
    {
        $box = Boxes::with('cells.folders')->with('workplace')->findOrFail($id);
        return view('boxes.show', [
            'box' => $box
        ]);
    }

    public function edit($id)
    {
        $box = Boxes::findOrFail($id);
        return view('boxes.edit', [
            'box' => $box
        ]);
    }

    public function destroy($id)
    {
        $box = Boxes::findOrFail($id);
        $box->delete();
        return redirect()->route('workplaces.show', $box->workplace_id)
            ->with('success', 'Шкаф "' . $box->title . '" успешно удален');
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
                return redirect()->route('boxes.show', [
                    $box->id
                ])->with('success',
                    'Создана новая ячейка с именем "' . $cell->title . '" в Шкафу "' . $box->title . '"');
            } catch (\DomainException $e) {
                return redirect()->back()->with('warning', $e->getMessage());
            }
        }
    }
}
