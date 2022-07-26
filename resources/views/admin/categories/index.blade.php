@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Категории товаров</p>
                    <button class="btn btn-sm" data-toggle="modal" data-target="#productSearchModal"><i class="fas fa-search"></i> Поиск...</button>                        
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Новая категория</a>
                    </div>
                                   
                </div>
                <div class="col-md-12">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Изобр.</th>
                            <th scope="col">Категория</th>
                            <th scope="col">Товаров/Просмотров</th>
                            <th scope="col">Ручной курс валют</th>
                            <th scope="col">Курс валют</th>
                            <th scope="col"></th>
                            {{-- <th scope="col">Описание</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 1
                        @endphp   
                        @forelse ($categories as $category)
                        
                        <tr js-click='checkbox' data-checkbox='{{ $category->id }}'>
                            <th scope="row">{{ $count++ }}</th>
                            <td class="not_click">
                                
                            </td>
                            <td>
                                <div class="uk-width-small">
                                    <img data-src="
                                    @if(isset($category->image))
                                        {{ asset('imgs/categories/')}}/{{ $category->image }}
                                    @else
                                        {{ asset('imgs/nopic.png')}}
                                    @endif
                                " class="card-img-top img-fluid" width="100" height="" alt="" uk-img>
                                </div>
                                
                            </td>
                            <td>
                                <a href="{{ route('admin.products.index', ['category' => $category->id]) }}">
                                    <h5 class="card-title">{{ $category->category }}</h5>
                                </a>
                                @isset($category->parents)
                                    <p class="card-text">родит.кат.: <a href="{{ route('admin.categories.edit', ['id' => $category->parents->id]) ?? '' }}" class="badge badge-light">{{ $category->parents->category }}</a></p>
                                @endisset
                            </td>
                            <td>
                                <span>товаров в категории: </span>{{ $category->products->count() }} | <span>просмотров: {{ $category->views }}</span>
                            </td>
                            <td>
                                <input type="checkbox" name="manualcurrencyrate_change" data-id={{ $category->id}} @if($category->manualcurrencyrate) checked @endif></td>
                            <td>

                            </td>
                            <td>
                                <div class='row'>                                
                                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                    <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.categories.destroy', $category)}}" method="post">
                                    @csrf                         
                                    <input type="hidden" name="_method" value="delete">                         
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>                                                 
                                </form>
                                </div>
                            </td>
                        </tr>
                        
                        @empty
                            <div class="alert alert-warning">Вы еще не добавили ни одной категории!</div>
                        @endforelse
                    </tbody>
                </table>
                <div class="paginate">
                    {{ $categories->appends(request()->input())->links('layouts.pagination') }}
                </div>
                        
            </div>
        </div>
    </div>
</div>


@endsection