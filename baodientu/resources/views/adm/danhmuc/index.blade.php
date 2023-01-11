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
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($danhmuc as $item)
                    <tr>
                        <td scope="row">{{ $item->ten_danh_muc }}</td>
                        <td>
                            @if ($item->trang_thai == 0)
                                <span class="text text-success">Hiển thị</span>
                            @else
                                <span class="text text-danger">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            @role('admin')
                                <a href="{{ route('danhmuc.edit', $item->id) }}" class="btn btn-info">Chỉnh sửa</a>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
