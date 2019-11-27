@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['url'=>route('workplaces.index'), 'label'=>'Рабочие места'],
            ['url'=>route('workplaces.show',$workplace->id), 'label'=>'Место: "'.$workplace->title.'"'],
            ['label'=>'Редактирование'],
        ]
    ])
    <div class="page-header">
        <h1>Редактирование рабочего места: "{{$workplace->title}}"</h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('workplaces.update',$workplace->id)}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="control-label">Название</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{$workplace->title}}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="control-label">Описание</label>
                    <textarea id="description"
                              class="form-control"
                              name="description"
                              rows="7">{{$workplace->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
