@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card edit_form">
                <div class="card-header"><p class="h3">Новый вариант товаров</p></div>
                <div class="card-body">                    
                    <form action="{{route('admin.choises.store')}}" method="post">
                        @csrf
                        {{-- Forme include --}}
            
                        @include('admin.choises.partials.form')
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection