@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot
    @slot('active') Статьи @endslot    
@endcomponent 
</section>
<section class="bg-light-grey products">
    <div class="wrap">
        <div class="col-lg-12"><h1>Статьи</h1></div>
        <section class="col-lg-12 row"> 
        @forelse ($articles as $article)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('article', $article->slug) }}">{{ $article->limit_title }}</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="card_description">{!! $article->short_description ?? '' !!}</div>
                    </div>
                </div>
            </div>
        @empty
            Здесь пока ничего нет
        @endforelse
        </section>
    </div>
</section>
    
    
      
@endsection