@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['url'=>route('documents.index'),'label'=> 'Документы'],
            ['label'=> 'Создание документа'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Создание документа
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Создание документа"
                       data-content="Судя по названию, здесь можно создать документ.
                       Название документа должно быть уникальным в пределах сервиса. Вы можете указать, к какой папке будет относиться документ, если это нужно.
                       Содержимое документа представляет из себя простой текст.
                       В дальнейшем на нашем сервисе будет реализовано хранение не только текстовой части документа, а также фото, видео и аудио записи. Совсем скоро...">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <form action="{{route('documents.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Уникальное имя документа:</label>
                    <input id="title" type="text" value="{{old('title')}}" name="title" class="form-control">
                    @error('title')
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
                    <label for="data" class="control-label">Содержимое</label>
                    <textarea id="data"
                              class="form-control"
                              name="data"
                              rows="15"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection


