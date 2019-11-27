@extends('layouts.app')
@section('content')
    @php
        $breadcrumbs = [['url'=>route('workplaces.index'),'label'=>'Рабочие места']];
            if(!empty($document->folder)){
                $breadcrumbs = array_merge($breadcrumbs,[
                    ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
                    ['url'=>route('workplaces.show',$document->folder->cell->box->workplace->id),'label'=> 'Место: "'.$document->folder->cell->box->workplace->title.'"'],
                    ['url'=>route('boxes.show',$document->folder->cell->box->id),'label'=> 'Шкаф: "'.$document->folder->cell->box->title.'"'],
                    ['url'=>route('cells.show',$document->folder->cell->id),'label'=> 'Ячейка: "'.$document->folder->cell->title.'"'],
                    ['url'=>route('folders.show',$document->folder->id),'label'=> 'Папка: "'.$document->folder->title.'"'],
                ]);
            }else{
                $breadcrumbs = [
                    ['url'=>route('documents.index'),'label'=>'Документы'],
                    ['label'=> 'Документ: "'.$document->title.'"']
                ];
            }
    @endphp
    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>$breadcrumbs
    ])
    <div class="page-header">
        <h1 class="display-4">
            Документ: "{{$document->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Просмотр документа"
                       data-content="Простой просмотр документа. Можете отсюда удалить его, если захотите.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    <div class="mb-3 clearfix">
        <form action="{{route('documents.destroy',$document->id)}}" method="POST"
              class="d-inline-block float-right ml-md-1"
              onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
        <a href="{{route('documents.edit',$document->id)}}" class="btn btn-primary float-right">
            <i class="fa fa-edit"></i> Редактировать
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            @if(!empty($document->data))
                {{$document->data}}
            @else
                <code>Документ пуст</code>
            @endif
        </div>
    </div>
@endsection
