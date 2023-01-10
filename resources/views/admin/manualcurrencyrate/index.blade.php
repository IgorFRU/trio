@extends('layouts.admin-app')

@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection

@section('content')
    <div class="uk-container uk-container-expand">
        <h1 class="uk-heading-small">Ручные курсы валют для категорий и производителей</h1>
    </div>

    <div class="uk-padding">
        {{-- <div class="uk-grid-small" uk-grid> --}}
            <form action="{{ route('admin.manualcurrencyrates.new') }}" method="post">
                @csrf
                <select class="uk-select uk-width-1-4@m uk-width-1-6@l uk-margin-left" name="category" id="manual_category">
                    <option value="0">-</option>
                    @include('admin.manualcurrencyrate.partials.child-categories', ['categories' => $categories, 'delimiter' => $delimiter])
                    
                </select>
        
                <select class="uk-select uk-width-1-4@m uk-width-1-6@l uk-margin-left" name="manufacture" id="manual_manufacture">
                    
                </select>

                @forelse ($currencies as $currency)
                    @if ($currency->to_update)
                        <input type="text" class="uk-input uk-width-1-6@m uk-width-1-8@l uk-margin-left" name="rate" placeholder="{{ $currency->currency_rus }}" data-id="{{ $currency->id }}">
                    @endif
                    
                @empty

                @endforelse    
                
                <button type="submit" class="uk-button uk-button-primary uk-margin-left" id="manual_currency_rate_save">Сохранить</button>
            </form>
        {{-- </div> --}}
    </div>

    <div class="uk-padding">
        {{-- <div class="uk-grid-small" uk-grid> --}}
            @forelse ($rates as $manualcurrencyrate)
                    <div class=" uk-margin-left uk-margin-remove-top" uk-grid>                        
                        <input type="text" class="uk-input uk-width-1-4@m uk-width-1-6@l uk-margin-left" name="manual_category" data-id="{{ $manualcurrencyrate->category->id }}" value="{{ $manualcurrencyrate->category->category }}"  disabled>
                        <input type="text" class="uk-input uk-width-1-4@m uk-width-1-6@l uk-margin-left" name="manufacture" data-id="{{ $manualcurrencyrate->manufacture->id }}" value="{{ $manualcurrencyrate->manufacture->manufacture }}"  disabled>
                        
                        <div class="uk-margin-left uk-width-1-5@m uk-width-1-7@l uk-form-horizontal">
                            <label class="uk-form-label" for="currency_id_{{ $manualcurrencyrate->currency->id }}">{{ $manualcurrencyrate->currency->currency_rus }}</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" name="rate" id="currency_id_{{ $manualcurrencyrate->currency->id }}" type="text" placeholder="{{ $manualcurrencyrate->currency->currency_rus }}" data-id="{{ $manualcurrencyrate->currency->id }}" value="{{ $manualcurrencyrate->rate }}">
                            </div>
                        </div>
                        <div class="uk-flex">
                            <button class="uk-button uk-button-primary uk-margin-left manual_currency_rate_update"><i class="fas fa-pen"></i></button>
                            <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.manualcurrencyrates.destroy', $manualcurrencyrate)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <input type="hidden" name="_method" value="delete"> --}}
                                <button type="submit" class="uk-button uk-button-danger manual_currency_rate_remove"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                        
                        
                    {{-- <input type="text" class="uk-input uk-width-1-6@m uk-width-1-8@l uk-margin-left" name="rate" placeholder="{{ $rate->currency->currency_rus }}" data-id="{{ $rate->currency->id }}" value="{{ $rate->rate }}"> --}}                    
                    </div>                    
            @empty
                
            @endforelse
            
        {{-- </div> --}}
    </div>
    
@endsection