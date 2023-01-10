@extends('layouts.admin-app')
@section('adminmenu')
    @parent
    @include('admin.partials.adminmenu')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="h3">Черный список IP</p>
                    <a href="{{ route('admin.blockip.create') }}" class="btn btn-primary">Добавить</a>                
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">IP</th>
                        <th scope="col">Начально диапазона</th>
                        <th scope="col">Конец диапазона</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1
                        @endphp
                        @forelse ($ips as $ip)
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $ip->ip ?? '-' }}</td>
                            <td>{{ $ip->start_ip ?? '-' }}</td>
                            <td>{{ $ip->stop_ip ?? '-' }}</td>
                            <td>
                                <div class='row'>                                
                                    <a href="{{ route('admin.blockip.edit', ['id' => $ip->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                    <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{ route('admin.blockip.destroy', $ip->id)}}" method="post">
                                    @csrf                         
                                    <input type="hidden" name="_method" value="delete">                         
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>                                                 
                                </form>
                                </div>
                            </td>
                          </tr>
                        @empty
                            Пусто
                        @endforelse                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection