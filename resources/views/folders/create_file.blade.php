@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>[
            ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
            ['url'=>route('workplaces.show',$folder->cell->box->workplace->id),'label'=> 'Место: "'.$folder->cell->box->workplace->title.'"'],
            ['url'=>route('boxes.show',$folder->cell->box->id),'label'=> 'Шкаф: "'.$folder->cell->box->title.'"'],
            ['url'=>route('cells.show',$folder->cell->id),'label'=> 'Ячейка: "'.$folder->cell->title.'"'],
            ['url'=>route('folders.show',$folder->id),'label'=> 'Папка: "'.$folder->title.'"'],
            ['label'=> 'Загрузка файла в папку'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Загрузка файла в папку: "{{$folder->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Создание файла в папку"
                       data-content="Здесь вы можете загрузить файл, который будет сразу привязан к папке из которой вы попали сюда. Напомню, что имя файла должно быть уникальным в пределах сервиса">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <form action="{{route('folders.store_file',$folder->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="file">Файл:</label>
                    <input id="file" type="file" value="{{old('file')}}" name="file" class="form-control-file">
                    @error('file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="data" class="control-label">Описание</label>
                    <input id="data"
                           class="form-control"
                           name="data">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection


