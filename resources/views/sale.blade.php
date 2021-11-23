@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection

@section('content')
<section class="uk-section uk-section-small">
    <div class="uk-container">
        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid=''>
            <div class="uk-text-center uk-first-column">
                <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                    @component('components.breadcrumb')
                        @slot('main') <i class="fas fa-home"></i> @endslot
                        @slot('parent') Акции @endslot
                            @slot('parent_route') {{ route('sales') }} @endslot   
                        @slot('active') {{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }} @endslot 
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">{{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }}</h1>
                <div class="card_info col-lg-12 @if($sale->it_actuality) uk-text-success uk-text-bold @else uk-text-danger @endif">{{ $sale->start_d_m_y }} - {{ $sale->d_m_y }} @if(!$sale->it_actuality) <br>(акция закончилась!) @endif</div>
            </div>
                @if ($sale->description != NULL)
                    <div class="uk-card uk-card-default uk-card-body ">
                        
                            <div>{!! $sale->description !!}</div>
                    </div>                
                @endif      
        </div>
    </div>
</section>
      
@endsection
