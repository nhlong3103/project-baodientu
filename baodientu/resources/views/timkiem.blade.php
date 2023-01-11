@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <hr>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-reset text-decoration-none">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm cho "{{ $search_str }}" là:</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <h5>Tin mới</h5>
        <div class="col-md-12">
            <div class="row">
                @foreach ($baiviet as $item)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <a
                                    href="{{ route('xembaiviet', ['id' => $item->id, 'slug' => Str::slug($item->tieu_de)]) }}">
                                    <img src="{{ url('public') }}/uploads/baiviet/{{ $item->anh_gioi_thieu }}"
                                        style="width: 100%; height: 100%;">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5>
                                        <a class="text-reset text-decoration-none d-inline-block text-truncate"
                                            href="{{ route('xembaiviet', ['id' => $item->id, 'slug' => Str::slug($item->tieu_de)]) }}"
                                            style="max-width: 100%;">
                                            {{ $item->tieu_de }}
                                        </a>
                                    </h5>
                                    <p class="card-text">{{ $item->gioi_thieu }}</p>
                                    <p class="card-text"><small class="text-muted">Ngày đăng:
                                            {{ $item->updated_at }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
