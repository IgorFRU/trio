<div class="row">
    <div class="col-lg-4">
        <div class="form-group row">
            <label for="choise" class="col-sm-3 col-form-label">Вариант</label>
            <div class="col-md-9">
                <input type="text" name="choise" class="form-control" id="choise" value="{{ $choise->choise ?? '' }}" required maxlength="250">
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group row">
            <label for="type" class="col-md-4 col-form-label">Тип</label>
            <div class="col-md-8">
                <select class="form-control" id="type" name="type">
                    <option value="parent" @if (isset($choise->id)) @if ($choise->type === 'parent') selected @endif @endif>Родительский</option>
                    <option value="child" @if (isset($choise->id)) @if ($choise->type === 'child') selected @endif @endif>Дочерний</option>
                </select>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="mb-3 col-md-12">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div> 
</div>
   