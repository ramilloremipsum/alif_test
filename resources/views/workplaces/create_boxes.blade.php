@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>[
            ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
            ['url'=>route('workplaces.show',$workplace->id),'label'=> 'Место: "'.$workplace->title.'"'],
            ['label'=> 'Создание шкафов'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Создание шкафов на месте: "{{$workplace->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)"
                       data-toggle="popover"
                       data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Рабочие места"
                       data-content="Создайте шкафы для текущего рабочего места, просто указав кол-во создаваемых шкафов.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('workplaces.store_boxes',$workplace->id)}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="quantity" class="control-label">Количество для добавления</label>
                    <input id="quantity" type="text"
                           min="1" max="100" step="10" class="form-control" name="quantity"
                           value="{{old('quantity') ? old('quantity') : 10}}">
                    @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>
@endsection
