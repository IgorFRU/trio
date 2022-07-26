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
                        @slot('active') Доставка @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">Доставка</h1>
            </div>

            <div class="uk-grid-small" uk-grid>                
                <div class="uk-grid-margin uk-first-column uk-width-expand@m">
                    <div class="uk-grid-medium uk-grid" uk-grid="">
                        <div class="uk-width-expand">
                            <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                                <div class="uk-first-column">
                                    <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                        <div class="uk-grid-collapse uk-child-width-1-1 uk-grid uk-grid-stack" id="products" uk-grid="">
                                            <div class="uk-card-header uk-first-column">
                                                
                                                <div uk-grid>
                                                    <div class="uk-width-auto@m">
                                                        <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                                                            @forelse ($deliverycategories as $item)
                                                            <li><a href="#">{{ $item->deliverycategory }}</a></li>
                                                            @empty
                                                    
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                    <div class="uk-width-expand@m">
                                                        <ul id="component-tab-left" class="uk-switcher">
                                                            @forelse ($deliverycategories as $item)
                                                                <li>
                                                                    {!! html_entity_decode($item->description) ?? "" !!}
                                                                    @if ($item->deliveries->count())
                                                                        <hr>
                                                                        <div>
                                                                            <table class="uk-table uk-table-striped uk-margin">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Сумма заказа от</th>
                                                                                        <th>Сумма заказа до</th>
                                                                                        <th>Масса от</th>
                                                                                        <th>Масса до</th>
                                                                                        <th>Цена</th>
                                                                                        <th>Описание</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            <tbody>
                                                                                @foreach ($item->deliveries as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->summ_start ?? "-" }} руб.</td>
                                                                                        <td>{{ $item->summ_end ?? "-" }} руб.</td>
                                                                                        <td>{{ $item->mass_start ?? "-" }} кг.</td>
                                                                                        <td>{{ $item->mass_end ?? "-" }} кг.</td>
                                                                                        <td>{{ $item->price ?? "-" }} руб.</td>
                                                                                        <td>{!! $item->description ?? "-" !!}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        
                                                                    @endif
                                                                </li>
                                                            @empty
                                                    
                                                            @endforelse
                                                            
                                                        </ul>
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


        </div>
    </div>
</section>
      
@endsection


