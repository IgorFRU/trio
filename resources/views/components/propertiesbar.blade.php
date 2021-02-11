
    <aside class="uk-width-1-5@m sidebar">
        <div class="uk-card uk-card-default uk-card-small uk-padding-small property">
            @if (count($manufactures) > 0)
            <h5 class="uk-heading-line property__title"><span>Производитель</span></h5>
                <div class="property__list">
                    @forelse ($manufactures as $manufacture)
                        <label><input class="uk-checkbox property__item" type="checkbox" data-property_id="manufacture" value="{{ $manufacture->id }}" name="manufacture" @foreach ($filteredManufacture as $item) @if ($manufacture->id == $item) checked @endif @endforeach> {{ $manufacture->manufacture }}</label>
                    @empty
                        
                    @endforelse
                    <button class="btn confirm_property_button btn btn-sm btn-info" title="Применить"><i class="fas fa-check"></i> Применить</button>

                </div>
            @endif

            {{-- @forelse ($category_properties as $category_property)
                <h5 class="uk-heading-line property__title"><span>{{ $category_property->property }} ({{$category_property->id}})</span></h5>
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid property__list">
                        @foreach ($properties as $property)
                            @if ($property->properties->id == $category_property->id)
                                <label><input class="uk-checkbox property__item" type="checkbox" data-property_id="{{ $property->property_id }}" value="{{ $property->value }}" name="{{ $category_property->property }}"> {{ $property->value }}</label>

                            @endif
                        
                    
                        @endforeach

                        <button class="btn confirm_property_button btn btn-sm btn-info" title="Применить"><i class="fas fa-check"></i> Применить</button>
                    
                </div>
            @empty
                
            @endforelse --}}
        </div>

        <form action="" method="post" id="properties">
            <input type="hidden" name="properties[]">
        </form>
    </aside>

