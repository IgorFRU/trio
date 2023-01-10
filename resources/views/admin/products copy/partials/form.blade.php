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
        
<nav class="nav nav-pills nav-fill tabs">
    <span class="nav-item nav-link @if (!isset($addImages)) active @endisset" data-tab="main">Основная информация</span>
    <span class="nav-item nav-link" data-tab="description1">Описание</span>
    <span class="nav-item nav-link" data-tab="size">Габариты</span>
    <span class="nav-item nav-link" data-tab="properties">Характеристики</span>
    <span class="nav-item nav-link add_photos_tab @if (isset($addImages)) active @endisset" data-tab="photos">Фотографии</span>
</nav>
<hr>
<div id="main" class="tab_item @if (!isset($addImages)) active @endisset">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">                
                <div class="col">
                    <div class="form-group row">
                        <label for="scu" class="col-sm-4 col-form-label">Артикул</label>
                        <div class="col-md-8">
                            <input type="text" name="scu" class="form-control" id="scu" value="{{ $product->scu ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
                <div class="col col-lg-3">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="published" name="published" value="{{ $product->published }}" @if($product->published) checked @endif>
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="published" id="published" value="1"  checked >
                            @endif
                            {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                            <input type="hidden" name="published" id="published" class="form-check-input js_oneclick_hidden" value="1" >
                            <label class="form-check-label" for="published">
                                Опубликован
                            </label>
                        </div>
                    </div>   
                </div>
                <div class="col col-lg-3">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($product->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="pay_online" name="pay_online" value="{{ $product->pay_online }}" @if($product->pay_online) checked @endif>
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="pay_online" id="pay_online" value="1"  checked >
                            @endif
                            {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                            <input type="hidden" name="pay_online" id="pay_online" class="form-check-input js_oneclick_hidden" value="1" >
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
                                <option></option>
                                @forelse ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
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
                            <option value="{{ $manufacture->id }}">{{ $manufacture->manufacture }}</option>
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
                            <option value="{{ $vendor->id }}">
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
                <div class="col col-lg-4">
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Цена</label>
                        <div class="col-md-8">
                            <input type="text" name="price" class="form-control" id="price" value="{{ $product->price ?? '' }}">
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
                                    <option value="{{ $discount->id }}">
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
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="packaging" id="packaging" value="1"  checked >
                            @endif
                            {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                            <input type="hidden" name="pay_online" id="pay_online" class="form-check-input js_oneclick_hidden" value="1" >
                            <label class="form-check-label" for="packaging">
                                Продажа упаковками
                            </label>
                        </div>
                    </div> 
                </div>
            </div>                      
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col col-lg-4">
                    <div class="p-3 mb-2 bg-success text-white">
                        <span>Итоговая цена: </span>
                        
                        <span></span>/
                        <span>уп.</span>

                    </div>
                </div>
                
            </div>
                      
        </div>
    </div>



    <input type="hidden" name="autoscu" class="form-control" id="autoscu" value="{{ $product->autoscu ?? '' }}">
    
    
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
                        <div class="col-md-12">
                            <select class="form-control" id="size_type" name="size_type">
                                <option></option>
                                <option value="mm">мм.</option>
                                <option value="cm">см.</option>
                                <option value="m">м.</option>
                            </select>
                        </div> 
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
    <p>Характеристики</p>
    
</div>



<div class="edit_form_bottom_menu">
    <div class="row align-middle">        
            <div class="input-group mb-3 col-md-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">id</span>
                </div>
                <input type="text" class="form-control" name="id" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $product->id ?? '' }}">
            </div>       
            {{-- <div class="input-group mb-3 col-md-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">арт.</span>
                </div>
                <input type="text" class="form-control" name="autoscu" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $product->autoscu ?? '' }}">
            </div> --}}
            <div class="input-group mb-3 col-md-7">
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
@if (!isset($addImages) && !isset($product->images))
    <button type="button" id="createproductandaddimages" class="btn btn-primary btn-lg btn-block">Добавить фотографии</button>
    
@else

</form>
       
<div id="photos" class="tab_item @if (isset($addImages)) active @endif">
<form action="{{ route('admin.product.image.upload') }}" id="upload_product_image" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12"> 
            
            <div class="col-lg-12 row">
                @isset($product->images)
                    @forelse ($product->images as $image)                
                        <div class="col-lg-2">
                            <img src="{{ asset('imgs/products/thumbnails')}}/{{ $image->thumbnail}}" alt="..." class="rounded img-fluid img-thumbnail @if($image->main) main_image @endif ">
                        </div>                
                    @empty
                        секция для отображения загруженных изображений 
                    @endforelse
                @endisset
            </div>
        </div>
    </div>
    <hr>
    
    <div class="col-lg-7">  
        <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label for="image" class="col-md-3 col-form-label">Изображение</label>
                    <div class="col-md-9">
                        <input type="file" class="custom-file-input" id="customFile" name="image">
                        <label class="custom-file-label" for="customFile">Выберите файл</label>
                    </div>                                    
                </div>    
            </div>
        </div>                 
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Название</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" value="{{ $image->name ?? '' }}">
                        </div>                                    
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-9">
                    <div class="form-group row">
                        <label for="alt" class="col-sm-4 col-form-label">"Alt"</label>
                        <div class="col-md-7">
                            <input type="text" name="alt" class="form-control" id="alt" value="{{ $image->alt ?? $product->product }}">
                        </div>                                    
                    </div>   
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="form-check">
                            @if(isset($image->id))
                                <input class="form-check-input js_oneclick" type="checkbox" id="main" name="main" value="{{ $image->main }}" @if($image->main) checked @endif>
                            @else
                                <input class="form-check-input js_oneclick" type="checkbox" name="main" id="main" value="1"  checked >
                            @endif
                            {{-- Скрытое поле для отправки на сервер value неотмеченного чекбокса --}}
                            <input type="hidden" name="pay_online" id="pay_online" class="form-check-input js_oneclick_hidden" value="1" >
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
                    <button type="submit" id="add_image" class="btn btn-primary" disabled>Добавить</button>
                </div>
                <div class="mb-3 col-md-2">
                    <button type="submit" id="add_image" disabled class="btn btn-secondary" disabled>Обновить</button>
                </div>
            </div>
        </div> 
    @endif
</form>
</div>