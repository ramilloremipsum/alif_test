@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['url'=>route('welcome'),'label'=>'Рабочие места'],
        ['url'=>route('workplaces.show',$folder->cell->box->workplace->id),'label'=> 'Место: "'.$folder->cell->box->workplace->title.'"'],
        ['url'=>route('boxes.show',$folder->cell->box->id),'label'=> 'Шкаф: "'.$folder->cell->box->title.'"'],
        ['url'=>route('cells.show',$folder->cell->id),'label'=> 'Ячейка: "'.$folder->cell->title.'"'],
        ['label'=> 'Папка: "'.$folder->title.'"'],]
    ])
    <div class="page-header">
        <h1 class="display-4">
            Папка: "{{$folder->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Папка и документы"
                       data-content="Вы находитесь в папке. В которой в свою очередь могут находиться файлы. Здесь вы, впрочем, как почти везде, можете редактировать и удалять папку.
                       Также, здесь вы можете сразу создать файл, относящийся к текущей папке.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
        <p class="text-muted">{{$folder->description}}</p>
    </div>
    <div class="mb-3 clearfix">
        <a href="{{route('folders.create_file',$folder->id)}}" class="btn btn-success"><i class="fa fa-plus"></i>
            <i class="fa fa-file-o"></i> Загрузить сюда файл
        </a>
        <form action="{{route('folders.destroy',$folder->id)}}" method="POST" class="d-inline-block float-right ml-md-1"
              onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
        <a href="{{route('folders.edit',$folder->id)}}" class="btn btn-primary float-right">
            <i class="fa fa-edit"></i> Редактировать
        </a>
    </div>
    <p>
    </p>
    @if(count($folder->files))
        <div class="row d-flex align-items-stretch">
            @foreach($folder->files as $file)
                <div class="col-md-3">
                    @include('widgets.item',[
                    'cardType'=>'file',
                    'cardTitle'=>$file->title,
                    'cardDescription'=>$file->description,
                    'cardShowRoute'=>route('file.show',$file->id),
                    'cardEditRoute'=>route('file.edit',$file->id),
                    'cardDestroyRoute'=>route('file.destroy',$file->id),
                    'destroyConfirm'=>[
                        'value'=> 'Вы хорошо подумали?'
                    ],
                    ])
                </div>
            @endforeach
        </div>
    @else

        <code>
            Здесь пока нет ни одного файла. <a href="{{route('folders.create_file',$folder->id)}}">Создать</a>
            или присвоить через <a href="{{route('file.index')}}">Файлы</a>
        </code>
    @endif
@endsection
