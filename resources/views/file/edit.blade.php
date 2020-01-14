@extends('layouts.app')
@section('content')

    @php
        $breadcrumbs = [['url'=>route('workplaces.index'),'label'=>'Рабочие места']];
            if(!empty($file->folder)){
                $breadcrumbs = array_merge($breadcrumbs,[
                    ['url'=>route('workplaces.show',$file->folder->cell->box->workplace->id),'label'=> 'Место: "'.$file->folder->cell->box->workplace->title.'"'],
                    ['url'=>route('boxes.show',$file->folder->cell->box->id),'label'=> 'Шкаф: "'.$file->folder->cell->box->title.'"'],
                    ['url'=>route('cells.show',$file->folder->cell->id),'label'=> 'Ячейка: "'.$file->folder->cell->title.'"'],
                    ['url'=>route('folders.show',$file->folder->id),'label'=> 'Папка: "'.$file->folder->title.'"'],
                    ['url'=>route('file.show',$file->id),'label'=> 'Документ: "'.$file->title.'"'],
                ]);
            };
        $breadcrumbs[] = ['label'=> 'Редактирование документа: "'.$file->title.'"'];
    @endphp
    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>$breadcrumbs
    ])
    <div class="page-header">
        <h1 class="display-4">
            Редактирование файла: {{$file->title}}
            <sup>
                <small>
                    <a href="javascript:void(0)" data-toggle="popover" data-trigger="focus"
                       class="text-dark d-inline-block"
                       title="Редактирование документа"
                       data-content="Здесь вы можете сменить название, содержимое, а также папку, к которой относится документ.
                       Имя документа должно быть уникальным в пределах сервиса.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </small>
            </sup>
        </h1>
    </div>
    @include('widgets.errors')
    <form action="{{route('file.update',$file->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Папка:</label>
                    <select class="form-control" name="folder_id">
                        <option value="">--- Выбрать папку ---</option>
                        @foreach ($folders as $folder_id => $title)
                            <option
                                value="{{ $folder_id }}" {{($folder_id == $file->folder_id) ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать</button>
    </form>
@endsection


