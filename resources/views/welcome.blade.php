@extends('layouts.app')
@section('content')

    <div class="jumbotron">
        <h1 class="display-2">Organizr</h1>
        <p class="lead">Привет! Это приложение поможет тебе привести твои документы в порядок.</p>
        @if($workplace)
            <a class="btn btn-outline-success btn-lg" href="{{ route('workplaces.index') }}" role="button"><i
                    class="fa fa-map-marker text-danger"></i>
                Перейти к местам
            </a>
        @else
            <hr class="my-2">
            <p>
                У тебя пока нечего организовывать.
                Для начала нужно создать рабочее место.
            </p>
            <a class="btn btn-outline-success btn-lg" href="{{ route('workplaces.create') }}" role="button"><i
                    class="fa fa-plus"></i>
                Создать рабочее место
            </a>
        @endif
    </div>

@endsection
