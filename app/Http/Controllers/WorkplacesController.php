<?php

namespace App\Http\Controllers;

use App\Exceptions\BoxAlreadyExistsInWorkplace;
use App\Helpers\Amate;
use App\Http\Requests\CreateBoxesInWorkplaceRequest;
use App\Http\Requests\StoreWorkplace;
use App\Workplaces;

class WorkplacesController extends Controller
{
    public function index()
    {
        $workplaces = Workplaces::all();
        return view('workplaces.index', [
            'workplaces' => $workplaces
        ]);
    }

    public function create()
    {
        return view('workplaces.create');
    }

    public function store(StoreWorkplace $request)
    {
        if ($request->validated()) {
            Workplaces::create($request->all());
            return redirect()->route('workplaces.index')->with('success',
                'Рабочее место "' . $request->get('title') . '" успешно создано');
        }

        return view('workplaces.store');
    }

    public function update(StoreWorkplace $request, $id)
    {
        $workplace = Workplaces::findOrFail($id);
        if ($request->validated()) {
            try {
                $workplace->update($request->all());
            } catch (\DomainException $e) {
                return redirect()->back()->with('warning', $e->getMessage());
            }
            return redirect()->route('workplaces.show', $workplace->id)->with('success',
                'Рабочее место "' . $workplace->title . '" успешно обновлено');
        }
    }

    public function show($id)
    {
        $workplace = Workplaces::with('boxes.cells')->findOrFail($id);
        return view('workplaces.show', [
            'workplace' => $workplace
        ]);
    }

    public function edit($id)
    {
        $workplace = Workplaces::findOrFail($id);
        return view('workplaces.edit', [
            'workplace' => $workplace
        ]);
    }

    public function destroy($id)
    {
        $workplace = Workplaces::findOrFail($id);
        $workplace->delete();
        return redirect()->route('workplaces.index')->with('success',
            'Рабочее место "' . $workplace->title . '" успешно удалено');
    }

    public function create_boxes($id)
    {
        $workplace = Workplaces::findOrFail($id);
        return view('workplaces.create_boxes', [
            'workplace' => $workplace
        ]);
    }

    public function store_boxes(CreateBoxesInWorkplaceRequest $request, $id)
    {
        $workplace = Workplaces::findOrFail($id);
        if ($request->validated()) {
            $workplace->createBoxes($request);
            return redirect()->route('workplaces.show', $workplace->id)
                ->with('success', 'Создано  '
                    . Amate::rusSklon($request->get('quantity'), 'шкафов', 'шкафа', 'шкаф', 'шкафов') .
                    ' на рабочем месте "' . $workplace->title . '"');
        }
        return view('workplaces.create_boxes', [
            'workplace' => $workplace
        ]);
    }
}
