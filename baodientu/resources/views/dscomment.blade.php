@foreach ($comments as $comm)
    <div class="media">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
            class="mr-3" width="40">
        <div class="media-body">
            <h5 class="mt-0">{{ $comm->user > name }}</h5>
            <p>{{ $comm->content }}</p>
            @if (Auth::check())
                <form action="" method="POST">
                    <div class="form-group" style="display:none">
                        <label for="">Nội dung bình luận</label>
                        <textarea name="content" class="form-control" id="" rows="3" required="required"
                            placeholder="Nhập nội dung"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng bình luận</button>
                </form>
            @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Đăng nhập để
                    bình luận</button>
            @endif
            @foreach ($comm->replies as $item)
                <div class="media mt-3">
                    <a class="mr-3" href="#">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                            width="40">
                    </a>
                    <div class="media-body">
                        <h5 class="mt-0">{{ $item->user > name }}</h5>
                        <p>{{ $item->content }}</p>
                        @if (Auth::check())
                            <form action="" method="POST">
                                <div class="form-group" style="display:none">
                                    <label for="">Nội dung bình luận</label>
                                    <textarea name="content" class="form-control" id="" rows="3" required="required"
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
            @endforeach
        </div>
    </div>
@endforeach
