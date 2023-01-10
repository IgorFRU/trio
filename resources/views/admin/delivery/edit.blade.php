@extends('layouts.admin-app')

@section('scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/4ogn001qp1t620kw68fag111as9qnq1nqba3n4ycar2puh9p/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'#description',
            plugins: "anchor link insertdatetime lists"
        });
    </script>
@endsection
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card edit_form">
                <div class="card-header"><p class="h3">Редактирование доставки</p></div>
                <div class="card-body">
                    
                    
                    <form action="{{route('admin.delivery.update')}}" method="post" enctype="multipart/form-data" class="uk-form-stacked">
                        @csrf
                        {{-- Forme include --}}
            
                        @include('admin.delivery.partials.form')
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection