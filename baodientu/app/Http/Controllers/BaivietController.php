<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\danhmuc;
use App\Models\baiviet;

class BaivietController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:xemds baiviet',['only'=>['index']]);
        $this->middleware('permission:them baiviet',['only'=>['create','store']]);
        $this->middleware('permission:chinhsua baiviet',['only'=>['edit','update','destroy']]);
    }

    public function index()
    {
        $baiviet = baiviet::orderBy('id','DESC')->get();
        return view('adm.baiviet.index',compact('baiviet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = danhmuc::orderBy('id','DESC')->get();
        return view('adm.baiviet.create',compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tieu_de'=>'required|max:255',
            'gioi_thieu'=>'required|max:255',
            'anh_gioi_thieu'=>'required',
            'noi_dung'=>'required',
            'danhmuc_id'=>'required',
            'trang_thai'=>'required',
        ],[
            'tieu_de.required'=>'Bạn chưa điền tiêu đề',
            'gioi_thieu.required'=>'Bạn chưa điền giới thiệu',
            'anh_gioi_thieu.required'=>'Bạn chưa có ảnh giới thiệu',
            'noi_dung.required'=>'Bạn chưa điền nội dung',
            'danhmuc_id.required'=>'Bạn chưa chọn danh mục bài viết',
        ]);

        $baiviet = new baiviet();
        $baiviet->tieu_de = $data['tieu_de'];
        $baiviet->gioi_thieu = $data['gioi_thieu'];
        $baiviet->noi_dung = $data['noi_dung'];
        $baiviet->danhmuc_id = $data['danhmuc_id'];
        $baiviet->trang_thai = $data['trang_thai'];


        //thêm ảnh vào folder public/uploads
        $get_image = $request->anh_gioi_thieu;

        $path = 'public/uploads/baiviet/';
        $get_name_image = $get_image->getClientOriginalName();
        // thêm số random vào đuôi ảnh cho ảnh không bị trùng
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        // đưa ảnh tới đường dẫn $path với tên $new_image
        $get_image->move($path,$new_image);

        $baiviet->anh_gioi_thieu = $new_image;

        $baiviet->save();
        return redirect()->route('baiviet.index')->with('status','Thêm bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baiviet = baiviet::find($id);
        return view('adm.baiviet.show',compact('baiviet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $baiviet = baiviet::find($id);
        $danhmuc = danhmuc::orderBy('id','DESC')->get();
        return view('adm.baiviet.update',compact('baiviet','danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tieu_de'=>'required|max:255',
            'gioi_thieu'=>'required|max:255',
            'anh_gioi_thieu'=>'required',
            'noi_dung'=>'required',
            'danhmuc_id'=>'required',
            'trang_thai'=>'required',
        ],[
            'tieu_de.required'=>'Bạn chưa điền tiêu đề',
            'gioi_thieu.required'=>'Bạn chưa điền giới thiệu',
            'anh_gioi_thieu.required'=>'Bạn chưa có ảnh giới thiệu',
            'noi_dung.required'=>'Bạn chưa điền nội dung',
            'danhmuc_id.required'=>'Bạn chưa chọn danh mục bài viết',
        ]);

        $baiviet = baiviet::find($id);
        $baiviet->tieu_de = $data['tieu_de'];
        $baiviet->gioi_thieu = $data['gioi_thieu'];
        $baiviet->noi_dung = $data['noi_dung'];
        $baiviet->danhmuc_id = $data['danhmuc_id'];
        $baiviet->trang_thai = $data['trang_thai'];


        //thêm ảnh vào folder public/uploads
        $get_image = $request->anh_gioi_thieu;

        if($get_image){
            $path = 'uploads/baiviet/'.$baiviet->anh_gioi_thieu;
            if(file_exists($path)){
                unlink($path);
            }
        }

        $path = 'public/uploads/baiviet/';
        $get_name_image = $get_image->getClientOriginalName();
        // thêm số random vào đuôi ảnh cho ảnh không bị trùng
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        // đưa ảnh tới đường dẫn $path với tên $new_image
        $get_image->move($path,$new_image);

        $baiviet->anh_gioi_thieu = $new_image;

        $baiviet->save();
        return redirect()->route('baiviet.index')->with('status','Thêm bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baiviet = baiviet::find($id);
        $image_path = public_path('uploads/baiviet/'.$baiviet->anh_gioi_thieu);
        
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $baiviet->delete();
        return redirect()->route('baiviet.index')->with('status','Xóa truyện thành công');
    }
}
