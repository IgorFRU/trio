@extends('layouts.admin-app')

@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu2')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Вопросы и ответы</p>
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">Новый вопрос</a>                
                </div>
                @if ($questionsNew->count())
                    <h5 class="p-2">Вопросы без ответа</h5>
                @endif
                <div class="d-flex flex-wrap col-lg-12">
                    
                    @forelse ($questionsNew as $QN)
                        <div class="col-md-3 p-2">
                            <div class="card @if($QN->created_at <= $QN->updated_at) bg-warning @endif">
                                <div class="card-body" data-id="{{ $QN->id }}">
                                    <h5 class="card-title">{{ $QN->name }} @if( $QN->published ) <span class="badge badge-success">Опубликован</span> @endif</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $QN->created }}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $QN->ip }} - <a href="{{ url("/admin/questions/?ip={$QN->ip}") }}">{{ $QN->count_ip }}</a></h6>
                                    <p class="card-text">{{ $QN->short_question }}</p>
                                    <button type="button" class="btn btn-secondary btn-sm questionModal" data-toggle="modal" data-target="#questionModal">Открыть</button>
                                    <button type="button" class="btn btn-primary btn-sm questionAnswerModal" data-toggle="modal" data-target="#questionAnswerModal">Ответить</button>
                                </div>
                            </div>
                        </div>                            
                    @empty
                    <div class="alert alert-warning col-lg-12">Нет еще ни одного вопроса</div>
                    @endforelse
                    
                </div>

                @if ($questionsNew->count())
                    <h5 class="p-2">Вопросы с ответом</h5>
                @endif
                <div class="d-flex flex-wrap col-lg-12">
                    
                    @forelse ($questionsOld as $QO)
                        <div class="col-md-3 p-2">
                            <div class="card @if($QO->created_at <= $QO->updated_at) bg-warning @endif">
                                <div class="card-body" data-id="{{ $QO->id }}">
                                    <h5 class="card-title">{{ $QO->name }} @if( $QO->published ) <span class="badge badge-success">Опубликован</span> @endif</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $QO->created }}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $QO->ip }} - <a href="{{ url("/admin/questions/?ip={$QO->ip}") }}">{{ $QO->count_ip }}</a></h6>
                                    <p class="card-text">{{ $QO->short_question }}</p>
                                    <hr>
                                    <p class="card-text">{{ $QO->short_answer }}</p>
                                    <button type="button" class="btn btn-secondary btn-sm questionModal" data-toggle="modal" data-target="#questionModal">Открыть</button>
                                    <button type="button" class="btn btn-primary btn-sm questionAnswerModal" data-toggle="modal" data-target="#questionAnswerModal">Ответить</button>
                                </div>
                            </div>
                        </div>                            
                    @empty
                    <div class="alert alert-warning col-lg-12">Нет еще ни одного вопроса</div>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Вопрос от <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Имя</label>
                    <input type="text" name="name" class="form-control" id="" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Вопрос</label>
                    <textarea class="form-control" name="question" rows="5"></textarea>
                </div>
                <input type="hidden" name="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary questionModalSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questionAnswerModal" tabindex="-1" role="dialog" aria-labelledby="questionAnswerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ответ на вопрос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ответ</label>
                    <textarea class="form-control" name="answer" rows="5"></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="published" name="published">
                    <label class="form-check-label" for="published">
                        Опубликован
                    </label>
                </div>
                <input type="hidden" name="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary questionAnswerModalSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>
@endsection
