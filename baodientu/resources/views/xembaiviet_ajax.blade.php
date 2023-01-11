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
        {!! $baiviet->noi_dung !!}
    </div>
    <div class="container">
        <h4>Bình luận</h4>
        @if (Auth::check())
            {{-- Check xem đã đăng nhập chưa, nếu chưa đăng nhập thì chỉ hiện nút đăng nhập chứ chưa cho cmt --}}

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nội dung bình luận</label>
                    <input type="hidden" name="baiviet_id" value="{{ $baiviet->id }}" id="" class="form-control"
                        aria-describedby="helpId">
                    <textarea id="comment-content" class="form-control" placeholder="Nhập nội dung (*)"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="btn-comment">Đăng bình luận</button>
                <small id="comment-error" class="help-blog"></small>
            </form>
        @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Đăng nhập để bình
                luận</button>
        @endif
        <br>
        <div id="comment">
            <div class="media">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                    class="mr-3" width="40">
                <div class="media-body">
                    <h5 class="mt-0">Media heading</h5>
                    <p>Standing on the frontline when the bombs start to fall. Heaven is jealous of our love, angels are
                        crying from up above. Can't replace you with a million rings. Boy, when you're with me I'll give you
                        a taste. There’s no going back. Before you met me I was alright but things were kinda heavy. Heavy
                        is the head that wears the crown.</p>
                    @if (Auth::check())
                        <form action="" method="POST">
                            <div class="form-group" style="display:none">
                                <label for="">Nội dung bình luận</label>
                                <input type="hidden" name="baiviet_id" value="{{ $baiviet->id }}" id=""
                                    class="form-control" aria-describedby="helpId">
                                <textarea name="noi_dung" class="form-control" id="" rows="3" required="required"
                                    placeholder="Nhập nội dung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng bình luận</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Đăng nhập
                            để bình luận</button>
                    @endif
                    <div class="media mt-3">
                        <a class="mr-3" href="#">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                width="40">
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0">Media heading</h5>
                            <p>Greetings loved ones let's take a journey. Yes, we make angels cry, raining down on earth
                                from up above. Give you something good to celebrate. I used to bite my tongue and hold my
                                breath. I'm ma get your heart racing in my skin-tight jeans. As I march alone to a different
                                beat. Summer after high school when we first met. You're so hypnotizing, could you be the
                                devil? Could you be an angel? It's time to bring out the big balloons. Thought that I was
                                the exception. Bikinis, zucchinis, Martinis, no weenies.</p>
                            @if (Auth::check())
                                <form action="" method="POST">
                                    <div class="form-group" style="display:none">
                                        <label for="">Nội dung bình luận</label>
                                        <input type="hidden" name="baiviet_id" value="{{ $baiviet->id }}" id=""
                                            class="form-control" aria-describedby="helpId">
                                        <textarea name="noi_dung" class="form-control" id="" rows="3" required="required"
                                            placeholder="Nhập nội dung"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Đăng bình luận</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modelId">Đăng nhập để bình luận</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
        Launch
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng nhập ngay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" id="email" class="form-control" placeholder=""
                                aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" id="password" class="form-control" placeholder=""
                                aria-describedby="helpId">
                        </div>
                        <button type="button" class="btn btn-primary" id="btn-login">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@stop()

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#btn-login').click(function(ev) {
            ev.preventDefault();
            var _loginUrl = '{{ route('ajax.login') }}';
            var email = $('#email').val();
            var password = $('#password').val();
            var _csrf = '{{ csrf_token() }}';

            $.ajax({
                url: _loginUrl,
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: _csrf
                },
                success: function(request) {
                    console.log(request);
                }
            });
        })
    </script>

    <script>
        $('#btn-comment').click(function(ev) {
            ev.preventDefault();
            let content = $('#comment-content').val();
            let _commentUrl = '{{ route('ajax.comment', $baiviet->id) }}';
            var _csrf = '{{ csrf_token() }}';

            $.ajax({
                url: _commentUrl,
                type: 'POST',
                data: {
                    content: content,
                    _token: _csrf
                },
                success: function(request) {
                    if (request.error) {
                        $('#comment-error').html(request.error)
                    } else {
                        $('#comment-error').html('');
                        $('#comment-content').val('');
                        $('#comment').html(request);
                        console.log(request);
                    }

                }
            });
        })
    </script>

@stop()
