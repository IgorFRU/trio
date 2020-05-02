<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <label for="option" class="col-sm-4 col-form-label">Опция</label>
            <div class="col-md-6">
                <input type="text" name="option" class="form-control" id="option" value="{{ $option->option ?? '' }}" required maxlength="250">
            </div>                       
        </div>  
    </div>
    <div class="col-md-12">
        Для категорий:
        <div class="d-flex">
            @forelse ($categories as $category)
                <div class="form-group form-check m-2 d-block btn btn-success">
                    <input type="checkbox" class="form-check-input" id="category_{{ $category->id }}" value="{{ $category->id }}" name="category[]" 
                    @if (isset($option->id))
                        @forelse ($option->categories as $item)
                            @if ($category->id === $item->id)
                                checked
                            @endif
                        @empty
                            
                        @endforelse
                    @endif>
                    <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->category }}</label>
                </div>
            @empty
                вы не создали еще ни одной категории
            @endforelse
        </div>
    </div>
    <div class="mb-3 col-md-12">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div> 
</div>   