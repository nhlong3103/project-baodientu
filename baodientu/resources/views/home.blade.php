@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <h5 class="text-white" style="background-color: #7c0004;">Tin mới</h5>
                    </div>
                    @foreach ($baiviet as $item)
                        <div class="row">
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
                        </div>
                    @endforeach

                    <div class="pagi row">
                        {{ $baiviet->links() }}
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <h5 class="text-white" style="background-color: #7c0004;">Có thể bạn sẽ thích</h5>
                    @foreach ($baiviet_random as $item)
                        <hr>
                        <a class="text-reset text-decoration-none"
                            href="{{ route('xembaiviet', ['id' => $item->id, 'slug' => Str::slug($item->tieu_de)]) }}">
                            <h6>{{ $item->tieu_de }}</h6>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
