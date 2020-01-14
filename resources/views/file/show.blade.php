@extends('layouts.app')
@section('content')
    @php
        $breadcrumbs = [['url'=>route('workplaces.index'),'label'=>'Рабочие места']];
            if(!empty($file->folder)){
                $breadcrumbs = array_merge($breadcrumbs,[
                    ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
                    ['url'=>route('workplaces.show',$file->folder->cell->box->workplace->id),'label'=> 'Место: "'.$file->folder->cell->box->workplace->title.'"'],
                    ['url'=>route('boxes.show',$file->folder->cell->box->id),'label'=> 'Шкаф: "'.$file->folder->cell->box->title.'"'],
                    ['url'=>route('cells.show',$file->folder->cell->id),'label'=> 'Ячейка: "'.$file->folder->cell->title.'"'],
                    ['url'=>route('folders.show',$file->folder->id),'label'=> 'Папка: "'.$file->folder->title.'"'],
                ]);
            }else{
                $breadcrumbs = [
                    ['url'=>route('file.index'),'label'=>'Файлы'],
                    ['label'=> 'Файл: "'.$file->title.'"']
                ];
            }
    @endphp
    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>$breadcrumbs
    ])
    <div class="page-header">
        <h1 class="display-4">
            Файл: "{{$file->title}}"
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
        <form action="{{route('file.destroy',$file->id)}}" method="POST"
              class="d-inline-block float-right ml-md-1"
              onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{Storage::url('files/'.$file->title)}}">Просмотр</a>
        </div>
    </div>
@endsection
