@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
@endif

