<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>


<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{route('welcome')}}"><i class="fa fa-sitemap"></i> Organizr</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('workplaces.index')}}"><i
                                class="fa fa-map-marker text-danger"></i> Рабочие места<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('folders.index')}}"><i
                                class="fa fa-folder-o text-warning"></i> Папки<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('documents.index')}}"><i
                                class="fa fa-files-o text-primary"></i> Документы<span class="sr-only"></span></a>
                    </li>
                </ul>
                <form class="mx-2 my-auto d-inline w-50" action="/search" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control border border-right-0" name="q"
                               placeholder="Поиск по папкам или документам...">
                        <span class="input-group-append">
                    <button class="btn btn-outline-secondary border border-left-0" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <div class="wrp">
        <div class="container">
            @include('widgets.flashes')
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
@stack('scripts')
</body>
</html>
