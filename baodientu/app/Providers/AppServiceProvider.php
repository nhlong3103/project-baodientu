<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\danhmuc;
use Illuminate\Contracts\Pagination\Paginator as PaginationPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer("*",function($view)
        {
            $layoutDanhmuc = danhmuc::orderBy('ten_danh_muc','DESC')->where('trang_thai',0)->get();
            $view->with(compact('layoutDanhmuc'));
        });
    }
}
