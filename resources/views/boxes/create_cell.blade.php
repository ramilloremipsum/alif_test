@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{route('workplaces.index')}}">Рабочие места</a></li>
            <li class="breadcrumb-item"><a
                    href="{{route('workplaces.show',$box->workplace->id)}}">"{{$box->workplace->title}}"</a></li>
            <li class="breadcrumb-item"><a href="{{route('boxes.show',$box->id)}}">Шкаф: "{{$box->title}}"</a></li>
            <li class="breadcrumb-item active">Создание ячейки</li>
        </ol>
    </nav>
    <div class="page-header">
        <h1 class="display-4">
            Создание ячейки в Шкафу "{{$box->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Создание ячейки"
                       data-content="Создайте здесь ячейку для текущего шкафа. Имя должно быть уникальным в пределах текущего шкафа.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('boxes.store_cell',$box->id)}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="control-label">Название</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="control-label">Описание</label>
                    <textarea id="description"
                              class="form-control"
                              name="description"
                              rows="7">{{old('description')}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>
@endsection
