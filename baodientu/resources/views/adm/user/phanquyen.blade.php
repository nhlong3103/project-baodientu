@extends('layouts.app')
@section('content')
    @include('layouts.nav')
    <hr>
    <div class="container responsive">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cấp quyền cho user {{ $user->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('user.themquyen', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <h6>Vai trò hiện tại: {{ $name_role->name }}</h6>
                                <label for="">Cấp quyền</label>
                                <br>
                                @foreach ($permission as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                            @foreach ($get_permission_via_role as $item2)
                                        @if ($item->id == $item2->id)
                                            checked
                                        @endif @endforeach
                                            name="permission[]" id="{{ $item->id }}" value="{{ $item->name }}">
                                        <label class="form-check-label"
                                            for="{{ $item->id }}">{{ $item->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" name="themquyen" class="btn btn-primary">Lưu</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
