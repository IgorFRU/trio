@extends('layouts.main-app')
@section('content')
    <div class="error404">
        <div class="overlay"></div>
        <div class="container d-flex justify-content-center align-items-center">
            <div>
                <div class="h1 center-block mb-2">К сожалению, этой страницы нет</div>
                <div class="h4 mb-3">Почему? Возможно, страница удалена или вам дали неверную ссылку</div>
                <hr>
                <p class="mt-3">Эта ссылка не работает, зато работают все остальные. Проверьте :)</p>
            </div>
            
        </div>
    </div>
@endsection