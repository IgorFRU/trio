@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="uk-child-width-1-1 uk-text-center" uk-grid>
        
            <div class="uk-card uk-card-default uk-margin-top">
                    <div class="uk-card-title uk-flex uk-flex-between uk-padding-small">
                        <h3>Категории доставок</h3>
                        <div class="uk-inline">
                            <button class="uk-button uk-button-default" type="button"><i class="fas fa-wrench"></i> Действия</button>
                            <div uk-dropdown>
                                <ul class="uk-nav uk-dropdown-nav uk-text-left">
                                    <li class="uk-active">
                                        <a href="{{ route('admin.deliverycategories.create') }}" class="uk-button uk-button-link uk-button-small uk-margin-small-bottom"><i class="fas fa-plus"></i> Новая категория</a>
                                    </li>
                                    <li class="uk-active">
                                        <a href="{{ route('admin.delivery.create') }}" class="uk-button uk-button-link uk-button-small uk-margin-small-bottom"><i class="fas fa-plus"></i> Новая доставка</a>
                                    </li>
                                </ul>
                            </div>
                        </div>    
                    </div>
                        
                <div class="uk-grid uk-child-width-1-2@m uk-child-width-1-3@l uk-text-center uk-padding" uk-grid>
                    @forelse ($categories as $category)
                            <div class="uk-card uk-card-default uk-card-body">
                                <h3 class="uk-card-title"><a href="{{ route('admin.deliverycategories.show', ['category_id' => $category->id]) }}">{{ $category->deliverycategory ?? '' }}</a></h3>
                                <p>{{ mb_substr(strip_tags($category->description), 0, 50) }}{{ strlen ($category->description ) > 50 ? "..." : "" }}</p>
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
                        @empty
                            <p>Вы еще не добавили ни одной категории</p>                            
                        @endforelse                    
                </div>
            </div>
            {{-- <div class="paginate">
                {{ $categories->appends(request()->input())->links('layouts.pagination') }}
            </div> --}}
        
    </div>
</div>
@endsection