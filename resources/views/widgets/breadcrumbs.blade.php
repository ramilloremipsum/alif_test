<nav aria-label="breadcrumb" class="mt-2">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $breadcrumb)
            @if(isset($breadcrumb['url']))
                <li class="breadcrumb-item">
                    <a href="{{$breadcrumb['url']}}">
                        {{$breadcrumb['label']}}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{$breadcrumb['label']}}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
