@extends('layouts.app')
@section('content')
@include('layouts.nav')
<hr>
<div class="container responsive">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}" class="text-reset text-decoration-none">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nội dung của bài viết {{$baiviet->tieu_de}} là:</li>
        </ol>
    </nav>

    {!!$baiviet->noi_dung!!}
</div>

@endsection