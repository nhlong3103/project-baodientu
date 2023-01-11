<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\baiviet;
use App\Models\danhmuc;
use App\Models\comment;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $baiviet = baiviet::orderBY('id', 'DESC')->where('trang_thai', 0)->paginate(7);
        $baiviet_random = baiviet::inRandomOrder()->limit(15)->get();
        return view('home', compact('baiviet', 'baiviet_random'));
    }

    public function xembaiviet($id)
    {
        $baiviet = baiviet::find($id);
        $baiviet_random = baiviet::inRandomOrder()->limit(10)->get();
        $comments = comment::orderBY('id', 'DESC')->where('baiviet_id', $baiviet->id)->get();
        return view('xembaiviet', compact('baiviet', 'comments'));
    }

    public function xemdanhmuc($id)
    {
        $danhmuc = danhmuc::find($id);
        return view('xemdanhmuc', compact('danhmuc'));
    }

    public function timkiem()
    {
        $search_str = request()->search_string;
        $baiviet = baiviet::where('tieu_de', 'LIKE', '%' . $search_str . '%')->orderBy('id', 'DESC')->get();
        return view('timkiem', compact('baiviet', 'search_str'));
    }

    public function storecomment(Request $request, $id)
    {
        $baiviet_id = $id;
        $baiviet = baiviet::find($id);
        $data = $request->validate([
            'noi_dung' => 'required',
        ], [
            'noi_dung.required' => 'Bạn cần điền nội dung bình luận',
        ]);
        $comment = new comment();
        $comment->baiviet_id = $baiviet_id;
        $comment->user_id = Auth::user()->id;
        $comment->noi_dung = $data['noi_dung'];
        $comment->save();
        return redirect("xem-bai-viet/$id-" . Str::slug($baiviet->tieu_de))->with('status', 'Đã thêm bình luận');
    }
}