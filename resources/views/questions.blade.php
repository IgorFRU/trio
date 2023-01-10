@extends('layouts.main-app')

@section('content')
<section class="uk-section uk-section-small">
    <div class="uk-padding">
        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid=''>
            <div class="uk-text-center uk-first-column">
                <ul class="uk-breadcrumb uk-flex-center uk-margin-remove" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    @component('components.breadcrumb')
                        @slot('main') <i class="fas fa-home"></i> @endslot  
                        @slot('active') Вопросы и ответы @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">Вопросы о паркете и ответы на них</h1>

                <div class="uk-text-meta uk-margin-xsmall-top">Вопросов - {{ $questions->count() }}</div>
                <a class="uk-button uk-button-primary uk-margin" href="#modal-question" uk-toggle>Задать вопрос</a>
            </div>
            <div class="uk-grid-margin uk-first-column">
                <div class="uk-grid-medium uk-grid" uk-grid="">
                    <div class="uk-width-expand">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                            <div class="uk-first-column">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <div class="uk-grid-collapse uk-child-width-1-1 uk-grid uk-grid-stack" id="products" uk-grid="" uk-scrollspy="cls: uk-animation-fade; target: > div > .question; delay: 500; repeat: false">
                                        <div class="uk-card-header uk-first-column">
                                            @forelse ($questions as $question)
                                                <div class="question">
                                                    <h5 class="uk-card-title">{{ $question->name }}</h5>
                                                    <p class="uk-text-small uk-text-muted">{{ $question->created ?? '' }}</p>
                                                    <p>{{ $question->question }}</p>

                                                    @if ($question->answer)
                                                        <div class="uk-background-muted uk-padding-small uk-margin-left" uk-scrollspy="cls: uk-animation-slide-right; repeat: false">
                                                            <h5>Ответ</h5>
                                                            <p>{!! $question->answer !!}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            @empty
                                                
                                            @endforelse
                                        </div>
                                        <div class="uk-grid-margin uk-first-column">
                                            
                                            <div class="paginate uk-margin-left uk-margin-right uk-margin">
                                                {{ $questions->appends(request()->input())->links('layouts.pagination') }}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                

        </div>
    </div>
</section>

<div id="modal-question" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>        
        <form action="{{ route('send.question') }}" method="POST">
            @csrf
            <div class="uk-modal-body">
                <fieldset class="uk-fieldset uk-margin-top">     
                    <div class="uk-alert-warning" uk-alert>
                        <p>Обращаем ваше внимание на то, что все вопросы проходят премодерацию.</p>
                    </div>

                    <div class="uk-margin">
                        <input class="uk-input" name="name" type="text" placeholder="Ваше имя" required maxlength="30">
                    </div>                    
            
                    <div class="uk-margin">
                        <textarea class="uk-textarea" name="question" rows="4" placeholder="Текст вопроса (до 500 символов)" maxlength="500" required></textarea>
                    </div>

                    {{-- <div uk-grid="">
                        <div class="uk-margin uk-width-2-3">
                            <input class="uk-input" name="email" type="email" placeholder="e-mail (не обязательно)">
                        </div> 

                        <div class="uk-grid-small uk-child-width-auto uk-grid  uk-width-1-3">
                            <label><input class="uk-checkbox" name="notify" type="checkbox" uk-tooltip="На указанный e-mail вы получите уведомление об ответе" value="1"> Уведомление об ответе</label>
                        </div>
                    </div> --}}
                    <input type="hidden" name="ip">
                </fieldset>
            
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Закрыть</button>
                <button class="uk-button uk-button-primary" type="submit">Отправить</button>
            </div>
        </form>
    </div>
</div>
      
@endsection


