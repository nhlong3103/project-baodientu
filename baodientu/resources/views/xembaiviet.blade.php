@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <hr>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-reset text-decoration-none">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $baiviet->tieu_de }}</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h2>{{ $baiviet->tieu_de }}</h2>
        <br>
        {!! $baiviet->noi_dung !!}
    </div>
    <hr>
    <div class="container">
        <h4>Bình luận</h4>
        @if (Auth::check())
            {{-- Check xem đã đăng nhập chưa, nếu chưa đăng nhập thì chỉ hiện nút đăng nhập chứ chưa cho cmt --}}

            <form action="{{ route('comment.store', $baiviet->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nội dung bình luận</label>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control"
                        aria-describedby="helpId">
                    <textarea name="noi_dung" class="form-control" placeholder="Nhập nội dung (*)"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Đăng bình luận</button>
            </form>
        @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Đăng nhập để bình
                luận</button>
        @endif
        <hr>
        <div id="comment">
            @foreach ($comments as $item)
                <div class="media">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                        class="mr-3" width="40">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $item->user->name }}</h5>
                        <p>{{ $item->noi_dung }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.footer')
@endsection
