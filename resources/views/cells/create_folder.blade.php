@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Главная</a></li>
            <li class="breadcrumb-item">
                <a href="{{route('workplaces.index')}}">
                    Рабочие места
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('workplaces.show',$cell->box->workplace->id)}}">
                    Место: "{{$cell->box->workplace->title}}"
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('boxes.show',$cell->box->id)}}">
                    Шкаф: "{{$cell->box->title}}"
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('cells.show',$cell->id)}}">
                    Ячейка: "{{$cell->title}}"
                </a>
            </li>
            <li class="breadcrumb-item active">Создание папки</li>
        </ol>
    </nav>
    <div class="page-header">
        <h1 class="display-4">Создание папки в ячейке "{{$cell->title}}"</h1>
    </div>
    @include('widgets.errors')
    <form action="{{route('cells.store_folder',$cell->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="title">Уникальное имя папки:</label>
                    <input id="title" type="text" value="" name="title" class="form-control">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Описание</label>
                    <textarea id="description"
                              class="form-control"
                              name="description"
                              rows="7"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
@endsection

@push('scripts')

    <script type="text/javascript">
        let $workplace = $('select[name="workplace_id"]');
        let $box = $('select[name="box_id"]');
        let $cell = $('select[name="cell_id"]');
            @if(isset($folder))
        let workplace_id = {{$folder->cell->box->workplace->id}};
        let box_id = {{$folder->cell->box->id}};
        let cell_id = {{$folder->cell->id}};
            @else
        let workplace_id = '';
        let box_id = '';
        let cell_id = '';
        @endif

        $(document).ready(function () {
            getWorkplaces(workplace_id);
            @if(isset($folder))
            getBoxes(workplace_id, box_id);
            getCells(box_id, cell_id);
            @endif
            $workplace.on('change', function () {
                var workplaceID = jQuery(this).val();
                if (workplaceID) {
                    getBoxes(workplaceID);
                } else {
                    emptyBoxes();
                }
                emptyCells();
            });
            $box.on('change', function () {
                var boxID = jQuery(this).val();
                if (boxID) {
                    getCells(boxID)
                } else {
                    emptyBoxes();
                    emptyCells();
                }
            });


            function getWorkplaces(select_id = '') {
                $.ajax({
                    url: '/folders/get_workplaces',
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $workplace.empty().append('<option value="">--- Выберите рабочее место ---</option>');
                        $.each(data, function (key, value) {
                            $workplace.append('<option value="' + key + '">' + value + '</option>');
                        });
                        $workplace.find('option[value="' + select_id + '"]').attr('selected', 'true')
                    }
                });
            }

            function getBoxes(workplaceID, select_id = '') {
                $.ajax({
                    url: '/folders/get_boxes/' + workplaceID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $box.empty().append('<option value="">--- Выберите шкаф ---</option>');
                        $.each(data, function (key, value) {
                            $box.append('<option value="' + key + '">Шкаф: &#34;' + value + '&#34;</option>');
                        });
                        $box.find('option[value="' + select_id + '"]').attr('selected', 'true');
                    }
                });
            }

            function getCells(boxID, select_id = '') {
                $.ajax({
                    url: '/folders/get_cells/' + boxID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $cell.empty().append('<option value="">--- Выберите ячейку ---</option>');
                        $.each(data, function (key, value) {
                            $cell.append('<option value="' + key + '">Ячейка: &#34;' + value + '&#34;</option>');
                        });
                        $cell.find('option[value="' + select_id + '"]').attr('selected', 'true');
                    }
                });
            }

            function emptyBoxes() {
                $box.empty().append('<option value="">--- Выберите шкаф ---</option>');
            }

            function emptyCells() {
                $cell.empty().append('<option value="">--- Выберите ячейку ---</option>');
            }
        });
    </script>
@endpush


