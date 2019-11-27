@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['url'=>route('workplaces.index'),'label'=>'Рабочие места'],
        ['label'=> 'Место: "'.$workplace->title.'"'],]
    ])

    <div class="page-header">
        <h1 class="display-4">
            <i class="fa fa-map-marker"></i> Рабочее место: "{{$workplace->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Рабочее место и шкафы"
                       data-content="На рабочем месте может быть сколько угодно шкафов. Фиксируйте здесь все шкафы, относящиеся текущему рабочему месту.
                                     Здесь вы можете просмотреть, редактировать, удалить рабочее место, а также создать шкафы, принадлежащие этому месту.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
        <p class="text-muted">{{$workplace->description}}</p>
    </div>
    <div class="mb-3">
        <a href="{{route('workplaces.create_boxes',$workplace->id)}}" class="btn btn-success d-inline-block">
            <i class="fa fa-plus"></i>
            <i class="fa fa-cubes"></i> Добавить шкафы
        </a>
        <form action="{{route('workplaces.destroy',$workplace->id)}}" method="POST" class="d-inline-block float-right ml-md-1" onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
        <a href="{{route('workplaces.edit',$workplace->id)}}" class="btn btn-primary float-right d-inline-block">
            <i class="fa fa-trash"></i>
            Редактировать
        </a>
    </div>
    <p class="lead font-weight-normal">Шкафы рабочего места "{{$workplace->title}}":</p>
    @if(count($workplace->boxes))
        <div class="row">
            @foreach($workplace->boxes as $box)
                <div class="col-md-3 d-flex align-items-stretch">
                    @include('widgets.item',[
                    'cardType'=>'cube',
                    'cardTitle'=>$box->title,
                    'cardDescription'=>$box->description,
                    'cardShowRoute'=>route('boxes.show',$box->id),
                    'cardEditRoute'=>route('boxes.edit',$box->id),
                    'cardDestroyRoute'=>route('boxes.destroy',$box->id),
                    'badge'=>[
                        'colorCondition'=> count($box->cells)==0,
                        'value'=> count($box->cells),
                        'valuePrefix'=> 'Ячеек: ',
                    ],
                    'destroyConfirm'=>[
                        'value'=> $box->hasFolders()
                        ? 'Удалив этот шкаф, автоматичесик удалятся все относящиеся к нему ячейки, а также файлы в них. Продолжить?'
                        : 'Вы уверены?',
                    ],
                    ])
                </div>
            @endforeach
        </div>
    @else
        <code>Здесь пока нет ни одного шкафа. <a href="{{route('workplaces.create_boxes',$workplace->id)}}">Создать</a></code>
    @endif
@endsection
