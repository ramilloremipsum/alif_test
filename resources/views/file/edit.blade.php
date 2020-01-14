@extends('layouts.app')
@section('content')

    @php
        $breadcrumbs = [['url'=>route('workplaces.index'),'label'=>'Рабочие места']];
            if(!empty($document->folder)){
                $breadcrumbs = array_merge($breadcrumbs,[
                    ['url'=>route('workplaces.show',$document->folder->cell->box->workplace->id),'label'=> 'Место: "'.$document->folder->cell->box->workplace->title.'"'],
                    ['url'=>route('boxes.show',$document->folder->cell->box->id),'label'=> 'Шкаф: "'.$document->folder->cell->box->title.'"'],
                    ['url'=>route('cells.show',$document->folder->cell->id),'label'=> 'Ячейка: "'.$document->folder->cell->title.'"'],
                    ['url'=>route('folders.show',$document->folder->id),'label'=> 'Папка: "'.$document->folder->title.'"'],
                    ['url'=>route('documents.show',$document->id),'label'=> 'Документ: "'.$document->title.'"'],
                ]);
            };
        $breadcrumbs[] = ['label'=> 'Редактирование документа: "'.$document->title.'"'];
    @endphp
    @include('widgets.breadcrumbs',[
        'breadcrumbs'=>$breadcrumbs
    ])
    <div class="page-header">
        <h1 class="display-4">
            Редактирование документа: {{$document->title}}
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
    <form action="{{route('documents.update',$document->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Уникальное имя документа:</label>
                    <input id="title" type="text" value="{{$document->title}}" name="title" class="form-control">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Папка:</label>
                    <select class="form-control" name="folder_id">
                        <option value="">--- Выбрать папку ---</option>
                        @foreach ($folders as $folder_id => $title)
                            <option
                                value="{{ $folder_id }}" {{($folder_id == $document->folder_id) ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="data" class="control-label">Содержимое</label>
                    <textarea id="data"
                              class="form-control"
                              name="data"
                              rows="15">{{$document->data}}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать</button>
    </form>
@endsection


