@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div >        
        <div class="uk-card uk-card-default uk-margin-top uk-padding-small">
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
                <p>{!! html_entity_decode($category->description) ?? "" !!}</p>
                @if ($category->deliveries->count())
                <hr>
                <div>
                    <div class="uk-card-title uk-flex uk-flex-between uk-padding-small">
                        <h4>Список доставок</h4>
                        <a href="{{ route('admin.delivery.create', ['category_id' => $category->id]) }}" class="uk-button uk-button-link uk-button-small"><i class="fas fa-plus"></i>  Добавить доставку</a>
                    </div>
                    <table class="uk-table uk-table-striped uk-margin">
                        <thead>
                            <tr>
                                <th>Сумма заказа от</th>
                                <th>Сумма заказа до</th>
                                <th>Масса от</th>
                                <th>Масса до</th>
                                <th>Цена</th>
                                <th>Описание</th>
                                <th>Приоритет</th>
                                <th></th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach ($deliveries as $item)
                            <tr>
                                <td>{{ $item->summ_start ?? "-" }} руб.</td>
                                <td>{{ $item->summ_end ?? "-" }} руб.</td>
                                <td>{{ $item->mass_start ?? "-" }} кг.</td>
                                <td>{{ $item->mass_end ?? "-" }} кг.</td>
                                <td>{{ $item->price ?? "-" }} руб.</td>
                                <td>{!! $item->description ?? "-" !!}</td>
                                <td>{{ $item->priority ?? "-" }}</td>
                                <td>
                                    <div class="uk-inline">
                                        <button class="uk-button uk-button-small" type="button"><i class="fas fa-wrench"></i> Действия</button>
                                        <div uk-dropdown>
                                            <ul class="uk-nav uk-dropdown-nav uk-text-left">
                                                <li class="uk-active">
                                                    <a href="{{ route('admin.delivery.edit', $item->id) }}" class="uk-button uk-button-link uk-button-small uk-margin-small-bottom"><i class="fas fa-pen"></i> Редактировать</a>
                                                </li>
                                                <li class="uk-active">
                                                    <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.delivery.destroy', $item->id)}}" method="post">
                                                        @csrf                         
                                                            <input type="hidden" name="_method" value="delete">                         
                                                            <button type="submit" class="uk-button uk-button-link uk-button-small uk-text-danger"><i class="far fa-trash-alt"></i>  Удалить</button>                                                 
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                
            @endif
            </div>
        </div>
        {{-- <div class="paginate">
            {{ $categories->appends(request()->input())->links('layouts.pagination') }}
        </div> --}}        
    </div>
</div>
@endsection