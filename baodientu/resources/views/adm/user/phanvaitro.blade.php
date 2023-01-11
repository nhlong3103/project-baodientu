@extends('layouts.app')
@section('content')
@include('layouts.nav')
<hr>
<div class="container responsive">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cấp vai trò cho user {{$user->name}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('user.themvaitro',$user->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="">Thêm vai trò (role)</label>
                            @foreach ($role as $item)
                                @if(isset($all_colum_roles))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{$item->id == $all_colum_roles->id ? 'checked' : ''}} type="checkbox" name="role[]" id="{{$item->id}}" value="{{$item->name}}">
                                        <label class="form-check-label" for="{{$item->id}}">{{$item->name}}</label>
                                    </div>
                                @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="role" id="{{$item->id}}" value="{{$item->name}}">
                                    <label class="form-check-label" for="{{$item->id}}">{{$item->name}}</label>
                                </div>
                                @endif
                            @endforeach
                        </div> 

                        <button type="submit" name="themvaitro" class="btn btn-primary">Lưu</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection