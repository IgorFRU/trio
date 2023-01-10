@extends('layouts.admin-app')
@section('scripts')
    @parent
    <script src="{{ asset('js/ajax_upload_product_image.js') }}" defer></script>
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
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card edit_form">
                <div class="card-header"><p class="h3">Редактирование товара 
                    <button type="button" class="btn btn-primary">{{ $product->product }}</button>
                    <button type="button" class="btn btn-link product_statistic" data-toggle="modal" data-target="#product_statistic">Статистика</button></p>
                </div>
                <div class="card-body">
                        {{-- Forme include --}}
                    
                        @include('admin.products.partials.form')
                    
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="product_statistic" tabindex="-1" role="dialog" aria-labelledby="product_statisticLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Статистика товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Просмотров товара: <span class="bold">{{ $product->views }} ({{ round(($product->views * 100) / $product->all_views, 2) }}% от всех товаров)</span></p>
                    <p>Просмотров товара: <span class="bold">{{ $product->all_views }}</span></p>
                </div>
                <div class="modal-footer">
                    <button   on type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection