@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Опции товаров</p>
                    <a href="{{ route('admin.options.create') }}" class="btn btn-primary">Новая опция</a>                
                </div>
                <div class="d-flex flex-wrap">
                    @forelse ($options as $option)
                        <div class="col-md-4 p-4">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $option->option }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                    <p class="card-text">
                                        @forelse ($option->categories as $category)
                                            <span class="mr-2">{{ $category->category }}</span>
                                        @empty
                                            
                                        @endforelse
                                    </p>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.options.edit', ['id' => $option->id]) }}" class="btn color-warning card-link mr-2"><i class="fas fa-pen"></i>  Редактировать</a>
                                        <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.options.destroy', $option)}}" method="post">
                                            @csrf                         
                                            <input type="hidden" name="_method" value="delete">                         
                                            <button type="submit" class="btn btn-danger card-link"><i class="far fa-trash-alt"></i>  Удалить</button>                                                 
                                        </form>
                                    </div>
                                </div>
                              </div>
                        </div>                            
                        @empty
                        <div class="alert alert-warning">Вы еще не добавили ни одной опции!</div>
                            
                        @endforelse
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Варианты</p>
                    <a href="{{ route('admin.choises.create') }}" class="btn btn-primary">Новый вариант</a>                
                </div>
                <div class="d-flex flex-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Тип</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($choises as $choise)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $choise->choise }}</td>
                                    <td>{{ $choise->type }}</td>
                                    <td></td>
                                </tr> 
                            @empty
                                <div class="alert alert-warning">Вы еще не добавили ни однго варианта!</div>                                
                            @endforelse
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection