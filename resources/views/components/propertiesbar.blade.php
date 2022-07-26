
    <aside class="uk-width-1-5@m sidebar">
        <div class="uk-card uk-card-default uk-card-small uk-padding-small property">
            @if (count($manufactures) > 0)
                <div class="uk-text-large uk-flex uk-flex-between uk-flex-stretch sidebar_title">
                    <span>Фильтр товаров</span>
                    <i class="fas fa-angle-down uk-hidden@m"></i>
                </div>
            @endif
            <div class="sidebar_body uk-margin-top">
                <div class=" uk-child-width-1-1@m uk-child-width-1-3@s uk-child-width-1-2" uk-grid>
                    @if (count($manufactures) > 0)
                        <div>
                            <h5 class="uk-heading-line property__title"><span>Производитель</span></h5>
                            <div class="property__list">
                                @forelse ($manufactures as $manufacture)
                                    <label><input class="uk-checkbox property__item" type="checkbox" data-property_id="manufacture" value="{{ $manufacture->id }}" name="manufacture" @foreach ($filteredManufacture as $item) @if ($manufacture->id == $item) checked @endif @endforeach> {{ $manufacture->manufacture }}</label>
                                @empty
                                    
                                @endforelse
                                <button class="btn confirm_property_button btn btn-sm btn-info" title="Применить"><i class="fas fa-check"></i> Применить</button>

                            </div>
                        </div>
                    @endif

                    @forelse ($category_properties as $category_property)
                        <div>
                            <h5 class="uk-heading-line property__title"><span>{{ $category_property->property }}</span></h5>
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid property__list">
                                    @foreach ($properties as $property)
                                        @if ($property->properties->id == $category_property->id)
                                            <label><input class="uk-checkbox property__item" type="checkbox" data-property_id="{{ $property->property_id }}" data-property_value="{{ $category_property->property }}" value="{{ $property->value }}" name="{{ $category_property->property }}" @isset($checked_properties[$property->property_id]) @if (in_array($property->value, $checked_properties[$property->property_id])) checked
                                                
                                            @endif @endisset> {{ $property->value }}</label>

                                        @endif                    
                                    @endforeach

                                    <button class="btn confirm_property_button confirm_property_button btn btn-sm btn-info" title="Применить"><i class="fas fa-check"></i> Применить</button>
                                
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
                <button class="uk-button uk-button-primary uk-button-small uk-margin-top uk-width-1-1 confirm_property_button confirm_property_button_mobile uk-hidden@m uk-padding uk-padding-remove-horizontal" title="Применить"><i class="fas fa-check"></i> Применить</button>
            </div>
        </div>

        <form action="" method="post" id="properties">
            <input type="hidden" name="properties[]">
        </form>
    </aside>

