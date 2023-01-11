@extends('layouts.app')
@section('content')
@include('layouts.nav')
<hr>
<div class="container responsive">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-striped table-inverse">
        <thead class="thead-inverse">
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò (role)</th>
                <th>Quyền (permission)</th>
                <th>Quản lý</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                        @foreach ($item->roles as $item2)
                            {{$item2->name}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item2->permissions as $item3)
                            <span class="badge badge-info">{{$item3->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('user.phanvaitro',$item->id)}}" class="btn btn-info">Chỉnh sửa vai trò</a>
                        <a href="{{route('user.phanquyen',$item->id)}}" class="btn btn-primary">Chỉnh sửa quyền cho vai trò</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>

@endsection