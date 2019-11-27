<div class="card mb-2 text-center {{isset($addClass) ? $addClass : ''}}">
    <div class="card-body position-relative">
        @if(isset($badge))
            <span class="badge badge-{{$badge['colorCondition'] ?'secondary': 'success'}} position-absolute"
                  style="top:10px;right: 10px;">{{$badge['valuePrefix']}}{{$badge['value']}}</span>
        @else
        @endif
        <a href="{{$cardShowRoute}}"
           class="text-decoration-none text-dark">
            <i class="fa fa-{{$cardType}}" style="font-size:200px"></i>
            <h4>{{$cardTitle}}</h4>
        </a>
        <p class="text-muted">{{$cardDescription}}</p>
        <a href="{{$cardShowRoute}}" class="btn btn-success btn-sm">
            <i class="fa fa-dot-circle-o"></i>
        </a>
        <a href="{{$cardEditRoute}}" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
        <form action="{{$cardDestroyRoute}}"
              @isset($destroyConfirm)
              onSubmit="return confirm('{{$destroyConfirm['value']}}')"
              @endisset
              method="POST"
              class="d-inline-block">
            @csrf
            <button type="submit"
                    class="btn btn-danger btn-sm btn-delete">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
</div>
