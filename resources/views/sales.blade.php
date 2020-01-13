@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot
    @slot('active') Акции @endslot    
@endcomponent 
</section>
<section class="bg-light-grey products">
    <div class="wrap">
        <div class="col-lg-12"><h1>Акции и скидки в "Паркетном мире"</h1></div>
        <section class="col-lg-12 row"> 
        @foreach ($sales as $sale)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('sale', $sale->slug) }}">{{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }}</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="card_info card_info_sale_date @if($sale->it_actuality) dark-green @else dark-red  @endif">{{ $sale->start_d_m_y }} - {{ $sale->d_m_y }}@if(!$sale->it_actuality)<br><span class="bold">(акция закончилась!)</span> @endif</div>
                        <div class="card_description">{{ $sale->short_description ?? '' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        </section>
    </div>
</section>
    
    
      
@endsection