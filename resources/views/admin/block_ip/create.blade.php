@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card edit_form">
                <div class="card-header"><p class="h3">Блокировка по IP</p></div>
                <div class="card-body">
                    
                    
                    <form action="{{route('admin.blockip.store')}}" method="post">
                        @csrf
                        {{-- Forme include --}}
            
                        @include('admin.block_ip.partials.form')
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection