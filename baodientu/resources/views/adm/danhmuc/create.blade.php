@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <hr>
    <div class="container responsive">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thêm danh mục truyện</div>

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

                        <form method="POST" action="{{ route('danhmuc.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên danh mục</label>
                                <input type="text" name="ten_danh_muc" id="" value="{{ old('ten_danh_muc') }}"
                                    class="form-control" placeholder="Điền tên danh mục vào phần này"
                                    aria-describedby="helpId">
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
                            <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
