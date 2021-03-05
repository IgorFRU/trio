
        
<nav class="nav nav-pills nav-fill tabs">
    <span class="nav-item nav-link @if (!isset($addImages)) active @endisset" data-tab="main">Основная информация</span>
    <span class="nav-item nav-link" data-tab="description1">Описание</span>
    <span class="nav-item nav-link" data-tab="size">Габариты</span>
    <span class="nav-item nav-link" data-tab="properties">Характеристики</span>
    <span class="nav-item nav-link add_photos_tab @if (isset($addImages)) active @endisset" data-tab="photos">Фотографии</span>
</nav>
<hr>
<form id="createproduct" 
    @isset($typeRequest)
        @if($typeRequest == 'create')
            action="{{route('admin.products.store')}}" 
        @elseif($typeRequest == 'edit')
            action="{{route('admin.products.update', $product)}}"
        @endif
    @endisset
    method="post">
    @isset($typeRequest)
        @if($typeRequest == 'edit')
            <input type="hidden" name="_method" value="put">        
        @endif
    @endisset             
            
        @csrf
<div id="main" class="tab_item @if (!isset($addImages)) active @endisset">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">                
                <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="scu" class="col-sm-6 col-form-label">Артикул</label>
                        <div class="col-md-6">
                            <input type="text" name="scu" class="form-control" id="scu" value="{{ $product->scu ?? '' }}">
                        </div>                                    
                    </div>    
                </div>                
                <div class="col col-lg-2">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="sample" name="sample" value="{{ $product->sample }}" @if($product->sample) checked @endif>                                
                                {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                                <input class="js_oneclick_hidden form-control" type="hidden" name="sample" id="sample" value="{{ $product->sample }}" >
                            @else                            
                                <input class="form-check-input js_oneclick" type="checkbox" id="sample" name="sample" value="1" checked>                                
                                {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                                <input class="js_oneclick_hidden form-control" type="hidden" name="sample" id="sample" value="1" >
                            @endif
                            <label class="form-check-label" for="sample">
                                Образец
                            </label>
                        </div>
                    </div>   
                </div>
                <div class="col col-lg-2">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="recomended" name="recomended" value="{{ $product->recomended }}" @if($product->recomended) checked @endif>
                                <input class="js_oneclick_hidden form-control" type="hidden" id="recomended" name="recomended" value="{{ $product->recomended }}">
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="recomended" id="recomended" value="0"  checked >
                                <input class="js_oneclick_hidden form-control" type="hidden" id="recomended" name="recomended" value="0">
                            @endif
                            <label class="form-check-label" for="recomended">
                                Реком.
                            </label>
                        </div>
                    </div>   
                </div>
                <div class="col col-lg-2">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="published" name="published" value="{{ $product->published }}" @if($product->published) checked @endif>
                                <input class="js_oneclick_hidden form-control" type="hidden" id="published" name="published" value="{{ $product->published }}">
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="published" id="published" value="1"  checked >
                                <input class="js_oneclick_hidden form-control" type="hidden" name="published" id="published" value="1">
                            @endif
                            <label class="form-check-label" for="published">
                                Опубликован
                            </label>
                        </div>
                    </div>   
                </div>
                <div class="col col-lg-2">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="pay_online" name="pay_online" value="{{ $product->pay_online }}" @if($product->pay_online) checked @endif>
                                <input class="js_oneclick_hidden form-control" type="hidden" id="pay_online" name="pay_online" value="{{ $product->pay_online }}">
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="pay_online" id="pay_online" value="0"  checked>
                                <input type="hidden" name="pay_online" id="pay_online" class="js_oneclick_hidden form-control" value="0" >
                            @endif
                            <label class="form-check-label" for="pay_online">
                                Оплата онлайн
                            </label>
                        </div>
                    </div>   
                </div>
            </div>            
            <div class="form-group row">
                <label for="product" class="col-sm-2 col-form-label">Название</label>
                <div class="col-md-10">
                    <input type="text" name="product" class="form-control" required id="product" value="{{ $product->product ?? '' }}">
                </div>                                    
            </div>   
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-4 col-form-label">Наличие (Симф.)</label>
                        <div class="col-md-8">
                            <input type="text" name="quantity" class="form-control" id="quantity" value="{{ $product->quantity ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="quantity_vendor" class="col-sm-6 col-form-label">Наличие (поставщик)</label>
                        <div class="col-md-6">
                            <input type="text" name="quantity_vendor" class="form-control" id="quantity_vendor" value="{{ $product->quantity_vendor ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="unit_in_package" class="col-sm-4 col-form-label">В упаковке</label>
                        <div class="col-md-8">
                            <input type="text" name="unit_in_package" class="form-control" id="unit_in_package" value="{{ $product->unit_in_package ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="unit_id" class="col-md-4 col-form-label">Ед. изм.</label>
                        <div class="col-md-8">
                            <select class="form-control" id="unit_id" name="unit_id">
                                <option disabled="disabled" @if (!isset($product->id)) selected @endif></option>
                                @forelse ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        @isset($product->unit_id)
                                            @if ($unit->id == $product->unit_id)
                                            selected = "selected"
                                            @endif
                                        @endisset>{{ $unit->unit }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div> 
                    </div>   
                </div>
            </div>                
        </div>
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="category_id" class="col-md-4 col-form-label">Категория</label>
                <div class="col-md-8">
                    <select class="form-control" id="category_id" name="category_id">
                        <option></option>
                        @include('admin.categories.partials.child-categories', ['categories' => $categories])
                    </select>
                </div> 
            </div>
            <div class="form-group row">
                <label for="manufacture_id" class="col-md-4 col-form-label">Производитель</label>
                <div class="col-md-8">
                    <select class="form-control" id="manufacture_id" name="manufacture_id">
                        <option></option>
                        @forelse ($manufactures as $manufacture)
                            <option value="{{ $manufacture->id }}"
                                @isset($product->manufacture_id)
                                    @if ($manufacture->id == $product->manufacture_id)
                                    selected = "selected"
                                    @endif
                                @endisset>{{ $manufacture->manufacture }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                </div> 
            </div> 
            <div class="form-group row">
                <label for="vendor" class="col-sm-4 col-form-label">Поставщик</label>
                <div class="col-md-8">
                    <select class="form-control" id="vendor" name="vendor_id">
                        <option></option>
                        @forelse ($vendors as $vendor)
                            <option value="{{ $vendor->id }}"
                                @isset($product->vendor_id)
                                    @if ($vendor->id == $product->vendor_id)
                                    selected = "selected"
                                    @endif
                                @endisset>
                                {{ $vendor->vendor }} 
                            </option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>                                    
            </div>   
            <div class="form-group row">
                <label for="delivery_time" class="col-sm-4 col-form-label">Срок поставки</label>
                <div class="col-md-8">
                    <input type="text" name="delivery_time" class="form-control" id="delivery_time" value="{{ $product->delivery_time ?? '' }}"> 
                </div>                                    
            </div>   
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col col-lg-2">
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Цена</label>
                        <div class="col-md-8">
                            <input type="text" name="price" class="form-control" id="price" value="{{ $product->price ?? '' }}">
                        </div>                                    
                    </div>    
                </div>                
                <div class="col col-lg-2">
                    <div class="form-group row">
                        <label for="currency_id" class="col-sm-4 col-form-label">Валюта</label>
                        <div class="col-md-8">
                            <select class="form-control" id="currency_id" name="currency_id">
                                @forelse ($currencies as $currency)
                                    <option value="{{ $currency->id }}"
                                        @isset($product->currency_id)
                                            @if ($currency->id == $product->currency_id)
                                            selected = "selected"
                                            @endif
                                        @endisset>
                                        {{ $currency->currency_rus ?? $currency->currency }}
                                    </option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>                                    
                    </div>    
                </div>
                <div class="col col-lg-4">
                    <div class="form-group row">
                        <label for="discount" class="col-sm-4 col-form-label">Акция</label>
                        <div class="col-md-8">
                            <select class="form-control" id="discount" name="discount_id">
                                <option></option>
                                @forelse ($discounts as $discount)
                                    <option value="{{ $discount->id }}"
                                        @isset($product->discount_id)
                                            @if ($discount->id == $product->discount_id)
                                            selected = "selected"
                                            @endif
                                        @endisset>
                                        {{ $discount->discount }} - 
                                        {{ $discount->value }} 
                                        {{ $discount->type }}
                                         - до 
                                         {{ Carbon\Carbon::parse($discount->discount_end)->locale('ru')->isoFormat('DD MMMM YYYY', 'Do MMMM') }}
                                    </option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>                                    
                    </div>    
                </div>
                <div class="col col-lg-4">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="packaging" name="packaging" value="{{ $product->packaging }}" @if($product->packaging) checked @endif>
                                <input class="js_oneclick_hidden form-control" type="hidden" id="packaging" name="packaging" value="{{ $product->packaging }}">
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="packaging" id="packaging" value="0" >
                                <input type="hidden" name="packaging" id="packaging" class="js_oneclick_hidden form-control" value="0" >
                            @endif
                            <label class="form-check-label" for="packaging">
                                Продажа упаковками
                            </label>
                        </div>
                    </div> 
                </div>
            </div>                      
        </div>
    </div>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".product_choises_modal">Опции</button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".product_childs_modal">Дочерние товары</button>

    <input type="hidden" name="autoscu" class="form-control" id="autoscu" value="{{ $product->autoscu ?? '' }}">
    
    <div class="modal fade product_choises_modal " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Опции товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="product_child_choises_parent">
                        <div class="product_child_choises_row">
                            <div class="d-flex w-100 row col-12">
                                <div class="col col-4">
                                    <div class="form-group row">
                                        <label for="product_child_choises" class="col-sm-6 col-form-label">Доч. вариант:</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="product_child_choises" name="product_child_choises">
                                                @forelse ($choises_children as $choise)
                                                    <option value="{{ $choise->id }}">{{ $choise->choise }}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select>
                                        </div>                                    
                                    </div>    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        {{-- <label for="product_child_choises_value" class="col-sm-5 col-form-label">Значение</label> --}}
                                        <div class="col-md-12">
                                            <input type="text" name="product_child_choises_value" class="form-control" id="product_child_choises_value" value="" maxlength="250" placeholder="значение">
                                        </div>                                    
                                    </div>    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        {{-- <label for="product_child_choises_value" class="col-sm-5 col-form-label">Значение</label> --}}
                                        <div class="col-md-12">
                                            <input type="text" name="product_child_choises_scu" class="form-control" id="product_child_choises_scu" value="" maxlength="250" placeholder="артикул">
                                        </div>                                    
                                    </div>    
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group row">
                                        <label for="product_child_choises_color" class="col-sm-6 col-form-label">Цвет</label>
                                        <div class="col-md-6">
                                            <input type="color" name="product_child_choises_color" class="form-control" id="product_child_choises_color" value="#012345" maxlength="250">
                                        </div>                                    
                                    </div>    
                                </div>
                            </div>
                            <div class="d-flex w-100 row col-12">
                                <div class="col-lg-3">
                                    <div class="form-group row">
                                        {{-- <label for="product_child_choises_image" class="col-md-6 col-form-label">Изображение</label> --}}
                                        <div class="col-md-12">
                                            <input type="file" class="custom-file-input" id="product_child_choises_image" name="product_child_choises_image">
                                            <label class="custom-file-label" for="product_child_choises_image">Изображение</label>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group row">
                                        {{-- <label for="product_child_choises_thumbnail" class="col-md-6 col-form-label">Миниатюра</label> --}}
                                        <div class="col-md-12">
                                            <input type="file" class="custom-file-input" id="product_child_choises_thumbnail" name="product_child_choises_thumbnail">
                                            <label class="custom-file-label" for="product_child_choises_thumbnail">Миниатюра</label>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col col-2">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <select class="form-control" id="product_child_choises_price_type" name="product_child_choises_price_type">                        
                                                <option value="original">Новая цена</option>
                                                <option value="+">+ к цене</option>
                                                <option value="-">- от цены</option>
                                            </select>
                                        </div>                                    
                                    </div>    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        {{-- <label for="product_child_choises_price_type" class="col-sm-7 col-form-label">Цена</label> --}}
                                        <div class="col-md-12">
                                            <input type="text" name="product_child_choises_price" class="form-control" id="product_child_choises_price" value="" placeholder="цена">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product_child_choises_hidden[]" value="">
                                <div class="col-2">
                                    <div class="btn btn-sm btn-success mr-2 ml-2 product_child_choises_add_button disabled" disabled><i class="fas fa-plus"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="modal fade product_childs_modal " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Дочерние товары</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="product_child_choises_parent">
                        <div class="product_child_choises_row">
                            <div class="d-flex w-100 row col-12">
                                <div class="col col-6">
                                    <div class="form-group row">
                                        <label for="productSearch_category_id" class="col-md-4 col-form-label">Категория</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="productSearch_category_id" name="productSearch_category_id">
                                                <option></option>
                                                @include('admin.categories.partials.child-categories', ['categories' => $categories])
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="input" class="form-control" id="productSearch" placeholder="Поиск...">

                                </div>
                                <div class="col-lg-12 my-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Внутр. арт.</th>
                                            <th scope="col">Арт.</th>
                                            <th scope="col">Название</th>
                                            <th scope="col">Цена (без скидки)</th>
                                            <th scope="col">Категория</th>
                                            <th scope="col">Наличие</th>
                                            </tr>
                                        </thead>
                                        <tbody  id="productSearchResult">
                                            <tr class="productSearchResult_item template hide">
                                                <th scope="row" class="productSearchResult_number"></th>
                                                <td class="autoscu"></td>
                                                <td class="scu"></td>
                                                <td class="product"><a href="" target="_blank"></a></td>
                                                <td class="price"></td>
                                                <td class="category"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <div class="loader_animate hide">
                                        <div class="cssload-loader">
                                            <span></span>
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
<div id="description1" class="tab_item">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="12">{{ $product->description ?? '' }}</textarea>
                </div>                                    
            </div>  
            <div class="form-group row">
                <label for="meta_description" class="col-sm-2 col-form-label">Описание для поисковых машин</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{ $product->meta_description ?? '' }}</textarea>
                </div>                                    
            </div> 
            <div class="form-group row">
                <label for="meta_keywords" class="col-sm-2 col-form-label">Ключевые слова для поисковых машин</label>
                <div class="col-md-10">
                    <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" value="{{ $product->meta_keywords ?? '' }}">
                </div>                                    
            </div>    
        </div>
    </div>
</div>
<div id="size" class="tab_item">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">                
                <div class="col col-lg-3">
                    <div class="form-group row">
                        <label for="size_l" class="col-sm-4 col-form-label">Длина</label>
                        <div class="col-md-8">
                            <input type="text" name="size_l" class="form-control" id="size_l" value="{{ $product->size_l ?? '' }}">
                        </div>                                    
                    </div>    
                </div>                
                <div class="col col-lg-3">
                    <div class="form-group row">
                        <label for="size_w" class="col-sm-4 col-form-label">Ширина</label>
                        <div class="col-md-8">
                            <input type="text" name="size_w" class="form-control" id="size_w" value="{{ $product->size_w ?? '' }}">
                        </div>                                    
                    </div>    
                </div>       
                <div class="col col-lg-3">
                    <div class="form-group row">
                        <label for="size_t" class="col-sm-4 col-form-label">Толщина</label>
                        <div class="col-md-8">
                            <input type="text" name="size_t" class="form-control" id="size_t" value="{{ $product->size_t ?? '' }}">
                        </div>                                    
                    </div>    
                </div>  
                <div class="col col-lg-3">
                    <div class="form-group row">
                        {{-- <label for="size_type" class="col-md-4 col-form-label">Ед. изм.</label> --}}
                        
                            <label for="size_type" class="col-lg-4 col-form-label">Ед.изм.</label>
                            <select class="form-control col-lg-6" id="size_type" name="size_type">
                                <option></option>
                                <option value="mm" 
                                @isset($product->size_type)
                                    @if ($product->size_type == 'mm')
                                    selected = "selected"
                                    @endif
                                @endisset>мм.</option>
                                <option value="cm" 
                                @isset($product->size_type)
                                    @if ($product->size_type == 'cm')
                                    selected = "selected"
                                    @endif
                                @endisset>см.</option>
                                <option value="m" 
                                @isset($product->size_type)
                                    @if ($product->size_type == 'm')
                                    selected = "selected"
                                    @endif
                                @endisset>м.</option>
                            </select>
                        
                    </div>   
                </div>                
            </div> 
            <div class="row">                
                <div class="col col-lg-3">
                    <div class="form-group row">
                        <label for="mass" class="col-sm-4 col-form-label">Масса (кг.)</label>
                        <div class="col-md-8">
                            <input type="text" name="mass" class="form-control" id="mass" value="{{ $product->mass ?? '' }}">
                        </div>                                    
                    </div>    
                </div>                
                <div class="col col-lg-3">
                    <div class="form-group row">
                        <label for="amount_in_package" class="col-sm-4 col-form-label">Штук в упаковке</label>
                        <div class="col-md-8">
                            <input type="text" name="amount_in_package" class="form-control" id="amount_in_package" value="{{ $product->amount_in_package ?? '' }}">
                        </div>                                    
                    </div>    
                </div>                
            </div> 
        </div>
    </div>
</div>
<div id="properties" class="tab_item">
    <div class="col-lg-12">
    @isset($properties)    
        @forelse ($properties as $property)        
            <div class="form-group row">
                <label for="{{ $property->id }}" class="col-sm-2 col-form-label">{{ $property->property }}</label>
                <div class="col-md-4">
                    <input type="text" name="property_values[{{ $property->id }}]" class="form-control" id="{{ $property->property }}" value=" {{ $propertyvalues[$property->id] ?? '' }} ">
                </div>                                    
            </div>
        @empty
            <div class="alert alert-warning">Вы еще не добавили ни одной характеристики для данной категории!</div>
        @endforelse
    @endisset
    </div>    
</div>



<div class="edit_form_bottom_menu">
    <div class="row align-middle">
            <div class="input-group mb-3 col-md-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">id</span>
                </div>
                <input type="text" class="form-control" name="id" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $product->id ?? '' }}">
            </div>
            <div class="input-group mb-3 col-md-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">art.</span>
                </div>
                <input type="text" class="form-control" name="id" disabled aria-label="art" aria-describedby="basic-addon1" value="{{ $product->autoscu ?? '' }}">
            </div>       
            {{-- <div class="input-group mb-3 col-md-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">арт.</span>
                </div>
                <input type="text" class="form-control" name="autoscu" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $product->autoscu ?? '' }}">
            </div> --}}
            <div class="input-group mb-3 col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">slug</span>
                </div>
                <input type="text" class="form-control" name="slug"  aria-label="Username" aria-describedby="basic-addon1" value="{{ $product->slug ?? '' }}">
            </div>
            <div class="mb-3 col-md-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <div class="mb-3 col-md-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Выйти</a>
            </div>
        </div>
</div>
<div class="hidden_inputs"></div> 
</form>

<div id="photos" class="tab_item">
    <div class="row">
        <div class="col-lg-12"> 
            {{-- <div class="col-lg-12 row" id="ajaxUploadedImages">
                
            </div> --}}
            
            <div id="ajaxUploadedImages" class="col-lg-12 row">
                @isset($product->images)
                    @forelse ($product->images as $image)  
                    @php
                        // dd($image);
                    @endphp              
                        <div class="col-lg-2">
                            <img data-id="{{ $image->id }}" data-name="{{ $image->name ?? '' }}" data-alt="{{ $image->alt ?? '' }}" src="{{ asset('imgs/products/thumbnails')}}/{{ $image->thumbnail}}" alt="..." class="rounded img-fluid img-thumbnail @if($image->main) main_image @endif ">
                        </div>                
                    @empty
                         
                    @endforelse
                @endisset
            </div>
        </div>
    </div>
    
    


    <form action="" id="uploadImagesForm" method="post" enctype="multipart/form-data">
        <div id="hiddenTypeForm"></div>
        @csrf
        <div class="col-lg-7">  
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="image" class="col-md-3 col-form-label">Изображение</label>
                        <div class="col-md-9">
                            <input type="file" class="custom-file-input" id="productImage" name="image">
                            <label class="custom-file-label" for="customFile">Выберите файл</label>
                        </div>  
                                                         
                    </div>    
                </div>
            </div>                 
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="filename" class="col-sm-3 col-form-label">Название</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="filename" value="{{ $image->name ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-9">
                    <div class="form-group row">
                        <label for="alt" class="col-sm-4 col-form-label">"Alt"</label>
                        <div class="col-md-7">
                            <input type="text" name="alt" class="form-control" id="alt" value="{{ $image->alt ?? '' }}">
                        </div>                                    
                    </div>   
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($image->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="main_img" name="main" value="{{ $image->main }}" @if($image->main) checked @endif>
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="main" id="main_img" value="1"  checked >
                            @endif
                            <input type="hidden" name="main_img" id="main" class="form-check-input js_oneclick_hidden" value="1" >
                            <label class="form-check-label" for="main">
                                Основное изображение
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
            <div class="form-group row">            
                <div class="mb-3 col-md-2">
                    <button type="submit" id="add_image" data-method='store' data-id='' class="btn btn-primary" disabled>Сохранить</button>
                </div>
                <div class="mb-3 col-md-2">
                    <div id="add_image_delete" disabled class="btn btn-danger disabled" disabled>Удалить</div>
                </div>
            </div>
        </div> 
    </form>
</div>


