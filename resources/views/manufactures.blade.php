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
                        @slot('active') Производители @endslot 
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">Производители</h1>
            </div>

            <div class="uk-grid-small" uk-grid>
                {{-- @if (count($category->property) > 0 )
                    @include('components.propertiesbar', ['min_price' =>$products->min('price'), 'category_properties' => $category->property, 'properties' => $properties, 'manufactures' => $manufactures, 'filteredManufacture' => $filteredManufacture ])
                    
                @endif --}}
                
                <div class="uk-grid-margin uk-first-column uk-width-expand@m">
                    <div class="uk-grid-medium uk-grid" uk-grid="">
                        {{-- <div class="uk-width-expand">
                            <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                                <div class="uk-first-column"> --}}
                                    <div class="uk-child-width-1-4@m uk-grid-small uk-grid-match" uk-grid>
                                        @foreach ($manufactures as $manufacture)
                                            <div class="uk-width-1-4@m uk-padding-small">
                                                <div class="uk-card uk-card-default uk-card-body ">
                                                    <h3 class="uk-card-title">
                                                        <a href="{{ route('manufacture', $manufacture->slug) }}" class="uk-button-text">{{ $manufacture->manufacture }}
                                                        @if ($manufacture->country != '' || $manufacture->country != NULL)
                                                            <p class="uk-text-small uk-text-meta">({{ $manufacture->country }})</p>
                                                        @endif</a>
                                                    </h3>
                                                    
                                                        @foreach ($manufacture->categories as $category)
                                                            {{ $category->category }}@if (!$loop->last), @endif
                                                        @endforeach
                                                    
                                                    <hr>
                                                    <p>{{ $manufacture->short_description ?? '' }}</p>
                                                </div>
                                                
                                            </div>
                                            
                                        @endforeach
                                    </div>
                                {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                </div>                
            </div>


        </div>
    </div>
</section>
      
@endsection



{{-- <section class="bg-light-grey products">
    <div class="wrap">
        <div class="col-lg-12"><h1>Производители</h1></div>
        <section class="col-lg-12 row"> 
        @foreach ($manufactures as $manufacture)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('manufacture', $manufacture->slug) }}">{{ $manufacture->manufacture }} @if ($manufacture->country != '' || $manufacture->country != NULL)
                            ({{ $manufacture->country }})
                       @endif</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="card_description">{{ $manufacture->short_description ?? '' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        </section>
    </div>
</section> --}}
    
    