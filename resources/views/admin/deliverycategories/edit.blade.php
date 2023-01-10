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
    <div class="uk-child-width-1-1 uk-text-center" uk-grid>
        
        <div class="uk-card uk-card-default uk-margin-top uk-padding">
            <h3 class="uk-card-title ">Редактирование категории <span>{{ $category->category }}</span></h3>                    
            <div class="uk-text-left">
                <form action="{{route('admin.deliverycategories.update', ['id' => $category->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    @include('admin.deliverycategories.partials.form')                
                </form>                
            </div>
        </div>
        {{-- <div class="paginate">
            {{ $categories->appends(request()->input())->links('layouts.pagination') }}
        </div> --}}
    
    </div>
</div>
@endsection