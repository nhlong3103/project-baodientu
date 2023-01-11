@extends('layouts.app')
@section('content')
@include('layouts.nav')
<hr>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Chỉnh sửa bài viết</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('baiviet.update',$baiviet->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="">Tiêu đề bài viết</label>
                            <input type="text" name="tieu_de" id="" value="{{$baiviet->tieu_de}}" class="form-control" placeholder="Điền tên danh mục vào phần này" aria-describedby="helpId">
                        </div> 

                        <div class="form-group">
                            <label for="">Giới thiệu</label>
                            <input type="text" name="gioi_thieu" id="" value="{{($baiviet->gioi_thieu)}}" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Ảnh giới thiệu</label>
                            <input type="file" name="anh_gioi_thieu" id="" class="form-control-file">
                            <img src="{{url('public/uploads/baiviet')}}/{{$baiviet->anh_gioi_thieu}}" width="200" height="240">
                        </div>

                        <div class="form-group">
                            <label for="">Nội dung</label>
                            <textarea type="text" name="noi_dung" id="summernote" value="{!!$baiviet->noi_dung!!}" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Danh mục bài viết</label>
                            <div>
                                <select class="form-control" name="danhmuc_id">
                                    @foreach ($danhmuc as $item)
                                        <option {{$item->id==$baiviet->danhmuc_id ? 'selected' : ''}} value="{{$item->id}}">{{$item->ten_danh_muc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="radio">
                                @if ($baiviet->trang_thai==0)
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="0" checked="checked">
                                        Hiển thị
                                    </label>
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="1">
                                        Ẩn
                                    </label>
                                @else
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="0">
                                        Hiển thị
                                    </label>
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="1" checked="checked">
                                        Ẩn
                                    </label>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#summernote').summernote({
          placeholder: 'Nhập nội dung vào đây',
          tabsize: 2,
          height: 300
        });
    </script>
@endsection