@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection

@section('content')
<section class="uk-section uk-section-small">
    <div class="uk-padding">
        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid=''>
            <div class="uk-text-center uk-first-column">
                <ul class="uk-breadcrumb uk-flex-center uk-margin-remove" itemscope="" itemtype="http://schema.org/BreadcrumbList">
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
                                                    
                                                        {{-- @foreach ($manufacture->categories as $category)
                                                            {{ $category->category }}@if (!$loop->last), @endif
                                                        @endforeach --}}
                                                    
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
    