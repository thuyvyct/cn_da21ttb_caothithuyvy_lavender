<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class SizeController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }
    public function add_size(){
        $this->AuthLogin();
        return view('admin.add_size');
    }
    public function all_size(){
        $this->AuthLogin();
        $all_size = DB::table('tbl_size')->get(); 
        return view('admin.all_size')->with('all_size', $all_size);
    }
    public function save_size(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['size_name'] = $request->size_name;
        $data['size_desc'] = $request->size_desc;
        $data['size_status'] = $request->size_status;

        DB::table('tbl_size')->insert($data);
        Session::put('message','Thêm Thành Công');
        return Redirect::to('all_size');
    }
    public function active_size($size_id){
        $this->AuthLogin();
        DB::table('tbl_size')->where('id',$size_id)->update(['size_status'=>0]);
        Session::put('message','Ẩn Thành Công');
        return Redirect::to('all_size');
    }
    public function unactive_size($size_id){
        $this->AuthLogin();
        DB::table('tbl_size')->where('id',$size_id)->update(['size_status'=>1]);
        Session::put('message','Hiển Thị Thành Công');
        return Redirect::to('all_size');
    }
    public function edit_size($size_id){
        $this->AuthLogin();
        $edit_size = DB::table('tbl_size')->where('id',$size_id)->get(); 
        return view('admin.edit_size')->with('edit_size', $edit_size);
    }
    public function delete_size($size_id){
        $this->AuthLogin();
        DB::table('tbl_size')->where('id',$size_id)->delete();
        Session::put('message','Xóa Thành Công');
        return Redirect::to('all_size');
    }
    public function update_size(Request $request, $size_id){
        $this->AuthLogin();
        $data = array();
        $data['size_name'] = $request->size_name;
        $data['size_desc'] = $request->size_desc;
        DB::table('tbl_size')->where('id',$size_id)->update($data);
        Session::put('message','Cập Nhật Thành Công');
        return Redirect::to('all_size');
    }
}
