@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['url'=>route('welcome'),'label'=>'Рабочие места'],
            ['url'=>route('workplaces.show',$cell->box->workplace->id),'label'=> 'Место: "'.$cell->box->workplace->title.'"'],
            ['url'=>route('boxes.show',$cell->box->id),'label'=> 'Шкаф: "'.$cell->box->title.'"'],
            ['url'=>route('cells.show',$cell->id),'label'=> 'Ячейка: '.$cell->title.'"'],
            ['label'=> 'Редактирование'],
        ]
    ])
    <div class="page-header">
        <h1>Редактирование ячейки</h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('cells.update',$cell->id)}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="control-label">Название</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{$cell->title}}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="control-label">Описание</label>
                    <textarea id="description"
                              class="form-control"
                              name="description"
                              rows="7">{{$cell->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
