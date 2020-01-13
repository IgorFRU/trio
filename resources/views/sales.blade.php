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
        <section class="col-lg-12 row"> 
        @foreach ($sales as $sale)
            <div class="card col-lg-4">
                <div class="card-header">
                    <h4><a href="{{ route('sale', $sale->slug) }}">{{ $sale->discount }} {{ $sale->value }}{{ $sale->rus_type }}</a></h4>
                </div>
                <div class="card-body">
                    <div class="card_info @if($sale->it_actuality) color-green  @endif">{{ $sale->start_d_m_y }} - {{ $sale->d_m_y }} @if(!$sale->it_actuality) <br>(акция закончилась!) @endif</div>
                    <p>{{ $sale->description ?? '' }}</p>
                </div>
                    
            </div>
        @endforeach
        </section>
    </div>
</section>
    
    
      
@endsection