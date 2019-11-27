@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['url'=>route('welcome'),'label'=>'Рабочие места'],
            ['url'=>route('workplaces.show',$box->workplace->id),'label'=> 'Место: "'.$box->workplace->title.'"'],
            ['url'=>route('boxes.show',$box->id),'label'=> 'Шкаф: "'.$box->title.'"'],
            ['label'=> 'Редактирование'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Редактирование шкафа: "{{$box->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Редактирование шкафа"
                       data-content="Можете сменить тут имя шкафа, а также редактировать описание.
                       Помните, что имя шкафа должно быть уникальным в пределах рабочего места.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('boxes.update',$box->id)}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="control-label">Название</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{$box->title}}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="control-label">Описание</label>
                    <textarea id="description"
                              class="form-control"
                              name="description"
                              rows="7">{{$box->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
