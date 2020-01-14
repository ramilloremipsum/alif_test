@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['label'=> 'Файлы'],]
    ])
    <div class="page-header">
        <h1 class="display-4"><i class="fa fa-files-o text-primary"></i>
            Файлы
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Файлы"
                       data-content="Здесь находятся оцифрованные файлы документов. Файлы могут быть привязаны к папке, а могут и не быть привязаны.
                        Имя документа должно быть уникальным и, по возможности, содержать данные в виде текста. Иначе зачем нужен документ?">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    <p>
        <a href="{{route('file.create')}}" class="btn btn-outline-success">
            <i class="fa fa-plus"></i> <i class="fa fa-file-o text-primary"></i> Добавить файл
        </a>
    </p>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>title</th>
            <th>address</th>
            <th>actions</th>
        </tr>
        @if(count($files))
            @foreach($files as $file)
                <tr>
                    <td>{{$file->id}}</td>
                    <td>
                        <a href="{{route('file.show',$file->id)}}">
                            {{$file->title}}
                        </a>
                    </td>
                    <td>
                        @if($file->folder)
                            <a href="{{route('file.show',$file->folder->id)}}">
                                {{$file->getAddressStr()}}
                            </a>
                        @else
                            Папка не определена
                        @endif
                    </td>
                    <td>
                        <a href="{{route('file.show',$file->id)}}" class="btn btn-outline-success btn-sm"><i
                                class="fa fa-dot-circle-o"></i></a>
                        <form action="{{route('file.destroy',$file->id)}}"
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
        @endif
    </table>
@endsection
