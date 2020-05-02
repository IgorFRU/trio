@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu2')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Парсер</p>
                    {{-- <a href="{{ route('admin.options.create') }}" class="btn btn-primary">Новая опция</a>                 --}}
                </div>
                <div class="d-flex flex-wrap">
                    <div class="col-lg-12 my-4">
                        <form action="{{ route('admin.parser')}}" method="post">
                            @csrf
                            <div class="form-group row col-12">
                                <label for="url" class="col-sm-2 col-form-label">Адрес сайта</label>
                                <div class="col-md-10">
                                    <input type="text" name="url" class="form-control" id="url" value="{{ $url ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="form-group row col-6">
                                    <label for="menu_class" class="col-sm-6 col-form-label">Селектор пунктов меню</label>
                                    <div class="col-md-6">
                                        <input type="text" name="menu_class" class="form-control" id="menu_class" value="{{ $menu_class ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="category_class" class="col-sm-6 col-form-label">Селектор категорий в меню</label>
                                    <div class="col-md-6">
                                        <input type="text" name="category_class" class="form-control" id="category_class" value="{{ $category_class ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="form-group row col-6">
                                    <label for="menu_only" class="col-sm-6 col-form-label">Парсить только эти меню</label>
                                    <div class="col-md-6">
                                        <input type="text" name="menu_only" class="form-control" id="menu_only" value="{{ $menu_only ?? '' }}" >
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="category_only" class="col-sm-6 col-form-label">И это подменю</label>
                                    <div class="col-md-6">
                                        <input type="text" name="category_only" class="form-control" id="category_only" value="{{ $category_only ?? '' }}" >
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="mb-3 col-md-2">
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </div>
                        </form>
                        
                        <div class="col-12 my-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Категория</th>
                                        <th scope="col">Продукт</th>
                                        <th scope="col">Объем/масса</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Цена за 1 кг./л.</th>
                                    </tr>
                                </thead>
                                @php
                                    $count = 1;
                                @endphp
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $count++ }}</th>
                                            <td>{{ $product->parent }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->value }}</td>
                                            <td>{{ number_format(round($product->price, 2), 2, '.', '') }}</td>
                                            <td>{{ number_format(round(floatval($product->price) / floatval($product->value), 2), 2, '.', '') }}</td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-12 my-2">
                            @forelse ($menus as $menu)
                                <a href="{{ $url . $menu->url }}" class="btn btn-light brn-sm m-1">{{ $menu->title }}</a>
                            @empty
                                
                            @endforelse
                        </div>

                        <div class="col-12 my-2">
                            <div class="accordion" id="accordionExample">
                                @php
                                    $count = 0;
                                @endphp
                                @forelse ($menus as $menu)
                                    @php
                                        $count++;
                                    @endphp
                                    <div class="card">
                                        <div class="card-header" id="heading {{ $count }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="{{ '#collapse' . $count }}" aria-expanded="true" aria-controls="{{ 'collapse' . $count }}">
                                                    {{ $menu->title }}
                                                </button>
                                            </h2>
                                        </div>                                        
                                        <div id="{{ 'collapse' . $count }}"  class="collapse" aria-labelledby="{{ 'heading' . $count }}" data-parent="#accordionExample">
                                            <div class="card-body row">
                                                @isset($menu->categories)                                                
                                                    @forelse ($menu->categories as $category)
                                                        <div class="col-3 my-2">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $category->title }}</h5>
                                                                    <span>
                                                                        {{ $category->url }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        
                                                    @endforelse
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection