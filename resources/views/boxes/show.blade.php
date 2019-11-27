@extends('layouts.app')
@section('content')
    @include('widgets.breadcrumbs',[
    'breadcrumbs'=>[
        ['url'=>route('welcome'),'label'=>'Рабочие места'],
        ['url'=>route('workplaces.show',$box->workplace->id),'label'=> 'Место: "'.$box->workplace->title.'"'],
        ['label'=> 'Шкаф: "'.$box->title.'"'],]
    ])
    <div class="page-header">
        <h1 class="display-4">
            <i class="fa fa-cube"></i> Шкаф: "{{$box->title}}"
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Шкафы и ячейки в них."
                       data-content="Просматривайте здесь ячейки из шкафа, добавляйте их (в шкафу может быть до {{\App\Boxes::MAX_CELLS_COUNT}} ячеек), а также редактируйте или удаляйте шкаф.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
        <p class="text-muted">{{$box->description}}</p>
    </div>
    <div class="mb-3">
        <a href="{{route('boxes.create_cell',$box->id)}}" class="btn btn-success d-inline-block">
            <i class="fa fa-plus"></i>
            <i class="fa fa-th"></i> Добавить ячейку
        </a>
        <form action="{{route('boxes.destroy',$box->id)}}" method="POST" class="d-inline-block float-right ml-md-1"
              onSubmit="return confirm('Вы уверены?')">
            @csrf
            <button class="btn btn-danger float-right" type="submit">
                <i class="fa fa-trash"></i>
                Удалить
            </button>
        </form>
        <a href="{{route('boxes.edit',$box->id)}}" class="btn btn-primary float-right d-inline-block">
            <i class="fa fa-trash"></i>
            Редактировать
        </a>
    </div>
    <p class="lead font-weight-normal">Ячейки шкафа "{{$box->title}}":</p>
    @if(count($box->cells))
        <div class="row d-flex align-items-stretch">
            @foreach($box->cells as $cell)
                <div class="col-md-3">
                    @include('widgets.item',[
                    'cardType'=>'th',
                    'cardTitle'=>$cell->title,
                    'cardDescription'=>$cell->description,
                    'cardShowRoute'=>route('cells.show',$cell->id),
                    'cardEditRoute'=>route('cells.edit',$cell->id),
                    'cardDestroyRoute'=>route('cells.destroy',$cell->id),
                    'badge'=>[
                        'colorCondition'=> count($cell->folders)==0,
                        'value'=> count($cell->folders),
                        'valuePrefix'=> 'Папок: ',
                    ],
                    'destroyConfirm'=>[
                        'value'=> $cell->hasFolders()
                        ? 'Удалив эту ячейку, вы удалите все папки, находящиеся в ней. Продолжить?'
                        : 'Вы уверены?',
                    ],
                    ])
                </div>
            @endforeach
        </div>
    @else
        <code>Здесь пока нет ни одной ячейки. <a href="{{route('boxes.create_cell',$box->id)}}">Создать</a></code>
    @endif
@endsection
