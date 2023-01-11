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
                <th>Tiêu đề</th>
                <th>Giới thiệu</th>
                <th>Ảnh giới thiệu</th>
                <th scope="row">Nội dung</th>
                <th>Thuộc danh mục</th>
                <th>Trạng thái</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($baiviet as $item)
            <tr>
                <td>{{$item->tieu_de}}</td>
                <td>{{$item->gioi_thieu}}</td>
                <td><img src="{{url('public/uploads/baiviet')}}/{{$item->anh_gioi_thieu}}" width="100" height="120"></td>
                <td><a class="btn btn-info" href="{{route('baiviet.show',$item->id)}}">Xem nội dung</a></td>
                <td>{{$item->danhmuc->ten_danh_muc}}</td>
                <td>
                    @if($item->trangthai==0)
                        <span class="text text-success">Hiển thị</span>
                    @else
                    <span class="text text-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    @role('admin')
                    <a href="{{route('baiviet.edit',$item->id)}}" class="btn btn-primary">Chỉnh sửa</a>
                    <form action="{{ route('baiviet.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" class="btn btn-danger">Xóa</button>
                    </form>
                    @endrole
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection