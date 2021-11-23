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
                        @slot('active') Акции @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">Акции и скидки в "Паркетном мире"</h1>
            </div>

            <div class="uk-grid-small" uk-grid>                
                <div class="uk-grid-margin uk-first-column uk-width-expand@m">
                    <div class="uk-grid-medium uk-grid" uk-grid="">
                            <div class=" uk-grid-small uk-grid-match" uk-grid>
                                @foreach ($sales as $sale)
                                    <div class="uk-width-1-3@m uk-padding-small">
                                        <div class="uk-card uk-card-default uk-card-body ">
                                            <h3 class="uk-card-title">
                                                <a href="{{ route('sale', $sale->slug) }}">{{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }}</a>
                                            </h3>
                                            
                                            <hr>
                                            <div class="card_info card_info_sale_date @if($sale->it_actuality) dark-green @else dark-red  @endif">{{ $sale->start_d_m_y }} - {{ $sale->d_m_y }}@if(!$sale->it_actuality)<br><span class="bold">(акция закончилась!)</span> @endif</div>
                                            <div class="card_description">{{ $sale->short_description ?? '' }}</div>
                                            <p>{{ $manufacture->short_description ?? '' }}</p>
                                        </div>
                                        
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>                
            </div>


        </div>
    </div>
</section>
      
@endsection