<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Danhmuc;

class DanhmucController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:xemds danhmuc', ['only' => ['index']]);
        $this->middleware('permission:them danhmuc', ['only' => ['create', 'store']]);
        $this->middleware('permission:chinhsua danhmuc', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $danhmuc = Danhmuc::orderBy('id', 'DESC')->get();
        return view('adm.danhmuc.index', compact('danhmuc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adm.danhmuc.create');
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
            'ten_danh_muc' => 'required|max:255|unique:danhmuc',
            'trang_thai' => 'required',
        ], [
            'ten_danh_muc.unique' => 'Danh mục đã tồn tại',
            'ten_danh_muc.required' => 'Bạn chưa điền tên danh mục',
        ]);

        $danhmuc = new Danhmuc();
        $danhmuc->ten_danh_muc = $data['ten_danh_muc'];
        $danhmuc->trang_thai = $data['trang_thai'];
        $danhmuc->save();

        return redirect()->route('danhmuc.index')->with('status', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = Danhmuc::find($id);
        return view('adm.danhmuc.update', compact('danhmuc'));
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
            'ten_danh_muc' => 'required|max:255',
            'trang_thai' => 'required',
        ], [
            'ten_danh_muc.required' => 'Bạn chưa điền tên danh mục',
        ]);

        $danhmuc = Danhmuc::find($id);
        $danhmuc->ten_danh_muc = $data['ten_danh_muc'];
        $danhmuc->trang_thai = $data['trang_thai'];
        $danhmuc->save();

        return redirect()->route('danhmuc.index')->with('status', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}