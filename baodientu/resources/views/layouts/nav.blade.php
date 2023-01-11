<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7c0004;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto">
                @foreach ($layoutDanhmuc as $item)
                    <li class="nav-item">
                        <a href="{{ route('xemdanhmuc', ['id' => $item->id, 'slug' => Str::slug($item->ten_danh_muc)]) }}"
                            class="nav-link text-white">{{ $item->ten_danh_muc }}</a>
                    </li>
                @endforeach
                @hasanyrole('admin|writer')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Quản lý danh mục
                        </a>
                        <div class="dropdown-menu">
                            @role('admin')
                                <a class="dropdown-item" href="{{ route('danhmuc.create') }}">Thêm danh mục</a>
                            @endrole
                            <a class="dropdown-item" href="{{ route('danhmuc.index') }}">Danh sách danh mục</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Quản lý bài viết
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('baiviet.create') }}">Thêm bài viết</a>
                            <a class="dropdown-item" href="{{ route('baiviet.index') }}">Danh sách bài viết</a>
                        </div>
                    </li>
                @endhasanyrole
                @role('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Quản lý tài khoản
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.index') }}">Danh sách tài khoản</a>
                        </div>
                    </li>
                @endrole
            </ul>

        </div>
    </div>
</nav>
