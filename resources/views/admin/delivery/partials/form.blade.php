<div class="uk-margin uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-grid>
    <div class="">
        <label class="uk-form-label" for="summ_start">Стоимость заказа от...</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="summ_start" name="summ_start" type="text" placeholder="Стоимость заказ от..." value="{{ $delivery->summ_start ?? '' }}">
        </div>
    </div>

    <div class="">
        <label class="uk-form-label" for="summ_end">Стоимость заказа до...</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="summ_end" name="summ_end" type="text" placeholder="Стоимость заказ до..." value="{{ $delivery->summ_end ?? '' }}">
        </div>
    </div>

    <div class="">
        <label class="uk-form-label" for="mass_start">Масса заказа от (кг.)...</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="mass_start" name="mass_start" type="text" placeholder="Масса заказа от (кг.)..." value="{{ $delivery->mass_start ?? '' }}">
        </div>
    </div>

    <div class="">
        <label class="uk-form-label" for="mass_end">Масса заказа до (кг.)...</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="mass_end" name="mass_end" type="text" placeholder="Масса заказа до (кг.)..." value="{{ $delivery->mass_end ?? '' }}">
        </div>
    </div>    

    <div class="">
        <label class="uk-form-label" for="price">Цена доставки, руб.</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="price" name="price" type="text" placeholder="Цена доставки, руб." value="{{ $delivery->price ?? '' }}">
        </div>
    </div>

    <div class="">
        <label class="uk-form-label" for="deliverycategory_id">Категория</label>
        <div class="uk-form-controls">
            <select class="uk-select" id="deliverycategory_id" name="deliverycategory_id">
                @forelse ($deliveries as $item)
                    <option value="{{ $item->id }}" @if ($category_id == $item->id) selected
                        
                    @endif>{{ $item->deliverycategory }}</option>
                @empty
                    --
                @endforelse
            </select>            
        </div>
    </div>

    <div class=" uk-width-1-1">
        <label class="uk-form-label" for="description">Описание</label>
        <div class="uk-form-controls">
            <textarea class="uk-textarea" rows="5" id="description" name="description" placeholder="Описание" maxlength="190">{{ $delivery->description ?? '' }}</textarea>
        </div>
    </div>    

    <div class=" uk-width-1-1">
        <label class="uk-form-label" for="priority">Приоритет</label>
        <div class="uk-form-controls">
            <input class="uk-range" type="range" id="priority" name="priority" value="{{ $delivery->description ?? '0' }}" min="0" max="20" step="1">
        </div>
    </div>
</div>

<div class="edit_form_bottom_menu">
    <div class="row align-middle">        
        <div class="input-group mb-3 col-md-1">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">id</span>
            </div>
            <input type="text" id="category_id-2" class="form-control" name="id" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $category->id ?? '' }}">
        </div>
        <div class="input-group mb-3 col-md-1">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-eye"></i></span>
            </div>
            <input type="text" class="form-control" name="views" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $category->views ?? '' }}">
        </div>
        <div class="input-group mb-3 col-md-6">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">slug</span>
            </div>
            <input type="text" class="form-control" name="slug" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $category->slug ?? '' }}">
        </div>
        <div class="mb-3 col-md-2">
                <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>  
        <div class="mb-3 col-md-2">
            <a href="{{ route('admin.deliverycategories.index') }}" class="btn btn-danger">Выйти</a>
        </div>              
    </div>
</div>