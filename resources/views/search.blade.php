@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Главная</a></li>
            <li class="breadcrumb-item active">Поиск: "{{$q}}"</li>
        </ol>
    </nav>
    <div class="page-header">
        <h1 class="display-4"><i class="fa fa-search text-info"></i> Поиск</h1>
    </div>
    <h3>Документы</h3>
    <ul>
        @if(!count($resultDocuments))
            <code>По запросу "{{$q}}" документов не найдено.</code>
        @else
            @foreach($resultDocuments as $resultDocument)
                <li>
                    <a href="{{route('documents.show',$resultDocument->id)}}">
                        {{$resultDocument->title}}
                    </a>
                    @if($resultDocument->folder)
                        : <a href="{{route('folders.show',$resultDocument->folder_id)}}">
                            {{$resultDocument->getAddressStr()}}
                        </a>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
    <h3>Папки</h3>
    <ul>
        @if(!count($resultFolders))
            <code>По запросу "{{$q}}" папок не найдено.</code>
        @else
            @foreach($resultFolders as $resultFolder)
                <li>
                    <a href="{{route('folders.show',$resultFolder->id)}}">
                        {{$resultFolder->title}}
                    </a>
                    :
                    <a href="{{route('cells.show',$resultFolder->cell_id)}}">
                        {{$resultFolder->getAddressStr()}}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
@endsection
