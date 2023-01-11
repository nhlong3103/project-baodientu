<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:quantri user',['only'=>['index','phanvaitro','themvaitro','phanquyen','themquyen']]);
    }

    public function index()
    {
        $user = user::with('roles','permissions')->get();
        return view('adm.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function phanvaitro($id)
    {
        // tìm user theo id
        $user = user::find($id);
        $role = role::orderBy('id','DESC')->get();
        $all_colum_roles = $user->roles->first(); //lấy user có vai trò gì trong bảng model has role
        return view('adm.user.phanvaitro',compact('user','role','all_colum_roles'));
    }

    public function themvaitro(Request $request, $id)
    {
        $data = $request->all();
        $user = user::find($id);
        $user->syncRoles($data['role']);
        return redirect()->route('user.index')->with('status','Thêm vai trò (role) thành công');
    }

    public function phanquyen($id)
    {
        // tìm user theo id
        $user = user::find($id);
        $permission = permission::orderBy('id','DESC')->get();
        $name_role = $user->roles->first(); //lấy ra vai trò mà user đang có
        // lấy quyền thông qua vai trò đang có
        $get_permission_via_role = $user->getPermissionsViaRoles();      
        return view('adm.user.phanquyen',compact('user','name_role','permission','get_permission_via_role'));
    }

    public function themquyen(Request $request, $id)
    {
        $data = $request->all();
        $user = user::find($id);
        $role_id = $user->roles->first()->id;
        //cấp quyền
        $role = role::find($role_id);
        $role->syncPermissions($data['permission']);  
        return redirect()->route('user.index')->with('status','Thêm quyền thành công');
    }
}
