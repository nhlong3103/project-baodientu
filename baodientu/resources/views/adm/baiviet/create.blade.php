@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <hr>
    <div class="container responsive">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thêm bài viết</div>

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
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('baiviet.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input type="text" name="tieu_de" id="" value="{{ old('tieu_de') }}"
                                    class="form-control" placeholder="Nhập tiêu đề" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for="">Giới thiệu</label>
                                <input type="text" name="gioi_thieu" id="" value="{{ old('gioi_thieu') }}"
                                    class="form-control" placeholder="Tối đa 110 ký tự" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for="">Ảnh giới thiệu</label>
                                <input type="file" name="anh_gioi_thieu" id="" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung</label>
                                <textarea type="text" name="noi_dung" id="summernote" value="{{ old('noi_dung') }}" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Danh mục bài viết</label>
                                <div>
                                    <select class="form-control" name="danhmuc_id">
                                        @foreach ($danhmuc as $item)
                                            <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="0"
                                            checked="checked">
                                        Hiển thị
                                    </label>
                                    <label>
                                        <input type="radio" name="trang_thai" id="" value="1">
                                        Ẩn
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Lưu bài viết</button>
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
