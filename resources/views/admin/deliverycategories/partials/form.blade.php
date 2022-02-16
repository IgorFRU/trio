<div class="uk-margin">
    <label class="uk-form-label" for="deliverycategory">Категория</label>
    <div class="uk-form-controls">
        <input class="uk-input" id="deliverycategory" name="deliverycategory" type="text" placeholder="Название категории доставки..." value="{{ $category->deliverycategory ?? '' }}">
    </div>
</div>

<div class="uk-margin">
    <label class="uk-form-label" for="description">Описание категории</label>
    <div class="uk-form-controls">
        <textarea class="uk-textarea" id="description" name="description" rows="30">{{ $category->description ?? '' }}</textarea>
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