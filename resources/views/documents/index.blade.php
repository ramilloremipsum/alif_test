@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['label'=> 'Документы'],]
    ])
    <div class="page-header">
        <h1 class="display-4"><i class="fa fa-files-o text-primary"></i>
            Документы
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Документы"
                       data-content="Здесь находятся все документы созданные за все время. Документы могут быть привязаны к папке, а могут и не быть привязаны.
                        Имя документа должно быть уникальным и, по возможности, содержать данные в виде текста. Иначе зачем нужен документ?">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    <p>
        <a href="{{route('documents.create')}}" class="btn btn-outline-success">
            <i class="fa fa-plus"></i> <i class="fa fa-file-o text-primary"></i> Создать документ
        </a>
    </p>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>title</th>
            <th>address</th>
            <th>actions</th>
        </tr>
        @if(count($documents))
            @foreach($documents as $document)
                <tr>
                    <td>{{$document->id}}</td>
                    <td>
                        <a href="{{route('documents.show',$document->id)}}">
                            {{$document->title}}
                        </a>
                    </td>
                    <td>
                        @if($document->folder)
                            <a href="{{route('folders.show',$document->folder->id)}}">
                                {{$document->getAddressStr()}}
                            </a>
                        @else
                            Папка не определена
                        @endif
                    </td>
                    <td>
                        <a href="{{route('documents.show',$document->id)}}" class="btn btn-outline-success btn-sm"><i
                                class="fa fa-dot-circle-o"></i></a>
                        <a href="{{route('documents.edit',$document->id)}}" class="btn btn-outline-primary btn-sm"><i
                                class="fa fa-edit"></i></a>
                        <form action="{{route('documents.destroy',$document->id)}}"
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
