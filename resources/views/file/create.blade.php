@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['url'=>route('file.index'),'label'=> 'Файлы'],
            ['label'=> 'Создание файла'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Создание файла
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Создание документа"
                       data-content="Судя по названию, здесь можно загрузить файл.
                       Название файла должно быть уникальным в пределах сервиса. Вы можете указать, к какой папке будет относиться файл, если это нужно.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <form action="{{route('file.store')}}" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Создать в папке:</label>
                    <select class="form-control" name="folder_id">
                        <option value="">--- Выбрать папку ---</option>
                        @foreach ($folders as $folder_id => $title)
                            <option value="{{ $folder_id }}">
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="control-label">Описание</label>
                    <input id="description"
                           class="form-control"
                           name="description">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection


