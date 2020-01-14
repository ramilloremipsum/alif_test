@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['label'=> 'Папки'],]
    ])
    <div class="page-header">
        <h1 class="display-4">
            <i class="fa fa-folder-o text-warning"></i> Папки
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Папки"
                       data-content="Здесь находятся все папки, созданные за все время. Папка должна быть привязана к определенной ячейке, иначе папку нельзя будет создать.
                       Папку можно перемещать с ячейки на ячейку в пределах сервиса.
                       Здесь вы можете создать, просмотреть, редактировать, удалить папку, а также перейти быстро к ячейке, к которой относится папка.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    <p>
        <a href="{{route('folders.create')}}" class="btn btn-outline-success">
            <i class="fa fa-plus"></i> <i class="fa fa-folder-o text-warning"></i> Создать папку
        </a>
    </p>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Кол-во файлов</th>
            <th>Адрес</th>
            <th>Действия</th>
        </tr>
        @if(count($folders))
            <div class="row">
                @foreach($folders as $folder)
                    <tr>
                        <td>{{$folder->id}}</td>
                        <td>
                            <a href="{{route('folders.show',$folder->id)}}">
                                {{$folder->title}}
                            </a>
                        </td>
                        <td>{{$folder->description}}</td>
                        <td>{{count($folder->files)}}</td>
                        <td>
                            <a href="{{route('cells.show',$folder->cell->id)}}">
                                {{$folder->getAddressStr()}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('folders.show',$folder->id)}}" class="btn btn-outline-success btn-sm"><i
                                    class="fa fa-dot-circle-o"></i></a>
                            <a href="{{route('folders.edit',$folder->id)}}" class="btn btn-outline-primary btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <form action="{{route('folders.destroy',$folder->id)}}"
                                  onSubmit="return confirm('Вы уверены?')"
                                  method="POST"
                                  class="d-inline-block">
                                @csrf
                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm btn-delete">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </div>
        @endif
    </table>
@endsection
