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
                       data-content="Вы находитесь в папке. В которой в свою очередь могут находиться документы. Здесь вы, впрочем, как почти везде, можете редактировать и удалять папку.
                       Также, здесь вы можете сразу создать документ, относящийся к текущей папке.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
        <p class="text-muted">{{$folder->description}}</p>
    </div>
    <div class="mb-3 clearfix">
        <a href="{{route('folders.create_document',$folder->id)}}" class="btn btn-success"><i class="fa fa-plus"></i>
            <i class="fa fa-file-o"></i> Создать здесь документ
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
    @if(count($folder->documents))
        <div class="row d-flex align-items-stretch">
            @foreach($folder->documents as $document)
                <div class="col-md-3">
                    @include('widgets.item',[
                    'cardType'=>'file',
                    'cardTitle'=>$document->title,
                    'cardDescription'=>$document->description,
                    'cardShowRoute'=>route('documents.show',$document->id),
                    'cardEditRoute'=>route('documents.edit',$document->id),
                    'cardDestroyRoute'=>route('documents.destroy',$document->id),
                    'destroyConfirm'=>[
                        'value'=> 'Вы хорошо подумали?'
                    ],
                    ])
                </div>
            @endforeach
        </div>
        @else

        <code>
            Здесь пока нет ни одного документа. <a href="{{route('folders.create_document',$folder->id)}}">Создать</a>
            или присвоить через <a href="{{route('documents.index')}}">Документы</a>
        </code>
    @endif
@endsection
