@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="uk-child-width-1-1" uk-grid>        
        <div class="uk-card uk-card-default uk-margin-top">
            <div class="uk-card-title uk-flex uk-flex-between uk-padding-small">
                <h3>{{ $category->deliverycategory ?? '' }}</h3>
                <div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><i class="fas fa-wrench"></i> Действия</button>
                    <div uk-dropdown>
                        <ul class="uk-nav uk-dropdown-nav uk-text-left">
                            <li class="uk-active">
                                <a href="{{ route('admin.deliverycategories.edit', ['id' => $category->id]) }}" class="uk-button uk-button-link uk-button-small"><i class="fas fa-pen"></i>  Редактировать</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.delivery.create', ['category_id' => $category->id]) }}" class="uk-button uk-button-link uk-button-small"><i class="fas fa-plus"></i>  Добавить доставку</a>
                            </li>
                            <hr>
                            <li>
                                <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.deliverycategories.destroy', $category->id)}}" method="post">
                                    @csrf                         
                                        <input type="hidden" name="_method" value="delete">                         
                                        <button type="submit" class="uk-button uk-button-link uk-button-small uk-text-danger"><i class="far fa-trash-alt"></i>  Удалить</button>                                                 
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>                
            <div class="uk-card-body">                    
                <p>{!! $category->description ?? "" !!}</p>                    
            </div>                       
        </div>
        {{-- <div class="paginate">
            {{ $categories->appends(request()->input())->links('layouts.pagination') }}
        </div> --}}        
    </div>
</div>
@endsection