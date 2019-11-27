@extends('layouts.app')
@section('content')

    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
            ['label'=>'Рабочие места'],
        ]
    ])
    <div class="page-header">
        <h1 class="display-4">
            <i class="fa fa-map-marker text-danger"></i> Рабочие места
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Рабочие места"
                       data-content="Рабочие места нужны для организации хранения документов на уровне комнат или других рабочих пространств.
               Если у вас все документы хранятся в одной комнате, то одного рабочего места вам будет достаточно.
               Создавать дополнительные места нужно в том случае, если вы решите хранить документы в нескольких комнатах или, к примеру, у себя на работе и дома.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    <p>
        <a href="{{'workplaces/create'}}" class="btn btn-outline-success">
            <i class="fa fa-plus"></i> <i class="fa fa-map-marker text-danger"></i> Создать рабочее место
        </a>
    </p>
    @if(count($workplaces))
        <div class="row">
            @foreach($workplaces as $workplace)
                <div class="col-md-4 d-flex align-items-stretch">
                    @include('widgets.item',[
                        'cardType'=>'map-marker',
                        'cardTitle'=>$workplace->title,
                        'cardDescription'=>$workplace->description,
                        'cardShowRoute'=>route('workplaces.show',$workplace->id),
                        'cardEditRoute'=>route('workplaces.edit',$workplace->id),
                        'cardDestroyRoute'=>route('workplaces.destroy',$workplace->id),
                        'destroyConfirm'=>[
                            'value'=> $workplace->hasBoxes()
                            ?'В этом рабочем месте есть шкафы. Вы уверены, что хотите удалить это место?'
                            :'Вы уверены?',
                        ],
                        'addClass'=> 'w-100'
                    ])
                </div>
            @endforeach
        </div>
    @else

        <code>Пока не создано ни одного рабочего места. <a href="{{route('workplaces.create')}}">Создать</a></code>
    @endif
@endsection
