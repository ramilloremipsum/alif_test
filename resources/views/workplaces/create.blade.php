@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
        ['label'=> 'Создание рабочего места'],]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Создание рабочего места
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Создание рабочего места"
                       data-content="Здесь вы можете заложить основу своей системы хранения документов, создав рабочее место.
                       Рабочее место - основная сущность, к которой уже в последующем будут принадлежать шкафы, ячейки, папки и документы.
                        Рабочих мест не придется создавать много, хотя кто знает...">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('workplaces.store')}}" method="post">
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
