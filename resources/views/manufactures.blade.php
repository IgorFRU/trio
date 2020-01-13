@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot
    @slot('active') Производители @endslot    
@endcomponent 
</section>
<section class="bg-light-grey products">
    <div class="wrap">
        <div class="col-lg-12"><h1>Производители</h1></div>
        <section class="col-lg-12 row"> 
        @foreach ($manufactures as $manufacture)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('manufacture', $manufacture->slug) }}">{{ $manufacture->manufacture }} @if ($manufacture->country != '' || $manufacture->country != NULL)
                            ({{ $manufacture->country }})
                       @endif</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="card_description">{{ $manufacture->short_description ?? '' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        </section>
    </div>
</section>
    
    
      
@endsection