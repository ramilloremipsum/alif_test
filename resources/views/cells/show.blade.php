@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
        ['url'=>route('workplaces.show',$cell->box->workplace->id),'label'=> 'Место: "'.$cell->box->workplace->title.'"'],
        ['url'=>route('boxes.show',$cell->box->id),'label'=> 'Шкаф: "'.$cell->box->title.'"'],
        ['label'=> 'Ячейка: "'.$cell->title.'"'],]
    ])
    <div class="page-header">
        <h1 class="display-4">
            <i class="fa fa-th"></i> Ячейка: "{{$cell->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Ячейка и папки"
                       data-content="В ячейке может быть сколько угодно папок, относящихся к ней.
                       Здесь вы можете сразу создать папку, присвоенную этой ячейке, минуя создание папок через раздел &#34;Папки&#34;">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
        <p class="text-muted">{{$cell->description}}</p>
    </div>

    <div class="mb-3">
        <a href="{{route('cells.create_folder',$cell->id)}}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <i class="fa fa-folder-o"></i> Создать здесь папку
        </a>
        <form action="{{route('cells.destroy',$cell->id)}}" method="POST" class="d-inline-block float-right ml-md-1"
              onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
        <a href="{{route('cells.edit',$cell->id)}}" class="btn btn-primary float-right d-inline-block">
            <i class="fa fa-trash"></i>
            Редактировать
        </a>
    </div>
    @if(count($cell->folders))
        <div class="row d-flex align-items-stretch">
            @foreach($cell->folders as $folder)
                <div class="col-md-3">
                    @include('widgets.item',[
                        'cardType'=>'folder',
                        'cardTitle'=>$folder->title,
                        'cardDescription'=>$folder->description,
                        'cardShowRoute'=>route('folders.show',$folder->id),
                        'cardEditRoute'=>route('folders.edit',$folder->id),
                        'cardDestroyRoute'=>route('folders.destroy',$folder->id),
                        'badge'=>[
                            'colorCondition'=> count($folder->files)==0,
                            'value'=> count($folder->files),
                            'valuePrefix'=> 'Файлов: ',
                        ],
                        'destroyConfirm'=>[
                            'value'=> $folder->hasFiles()
                            ?'Удалив папку, все входящие в нее файлы перестанут принадлежать какой-либо папке. Хотите продолжить удаление?'
                            :'Вы уверены?',
                        ],
                    ])
                </div>
            @endforeach
        </div>
    @else
        <code>Здесь пока нет ни одной папки. <a href="{{route('cells.create_folder',$cell->id)}}">Создать</a></code>
    @endif
@endsection
