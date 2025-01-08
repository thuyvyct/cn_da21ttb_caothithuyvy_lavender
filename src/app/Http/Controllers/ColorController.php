<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ColorController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }
    public function add_color(){
        $this->AuthLogin();
        return view('admin.add_color');
    }
    public function all_color(){
        $this->AuthLogin();
        $all_color = DB::table('tbl_color')->get(); 
        return view('admin.all_color')->with('all_color', $all_color);
    }
    public function save_color(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['color_name'] = $request->color_name;
        $data['color_status'] = $request->color_status;

        DB::table('tbl_color')->insert($data);
        Session::put('message','Thêm Thành Công');
        return Redirect::to('all_color');
    }
    public function active_color($color_id){
        $this->AuthLogin();
        DB::table('tbl_color')->where('id',$color_id)->update(['color_status'=>0]);
        Session::put('message','Ẩn Thành Công');
        return Redirect::to('all_color');
    }
    public function unactive_color($color_id){
        $this->AuthLogin();
        DB::table('tbl_color')->where('id',$color_id)->update(['color_status'=>1]);
        Session::put('message','Hiển Thị Thành Công');
        return Redirect::to('all_color');
    }
    public function edit_color($color_id){
        $this->AuthLogin();
        $edit_color = DB::table('tbl_color')->where('id',$color_id)->get(); 
        return view('admin.edit_color')->with('edit_color', $edit_color);
    }
    public function delete_color($color_id){
        $this->AuthLogin();
        DB::table('tbl_color')->where('id',$color_id)->delete();
        Session::put('message','Xóa Thành Công');
        return Redirect::to('all_color');
    }
    public function update_color(Request $request, $color_id){
        $this->AuthLogin();
        $data = array();
        $data['color_name'] = $request->color_name;
        DB::table('tbl_color')->where('id',$color_id)->update($data);
        Session::put('message','Cập Nhật Thành Công');
        return Redirect::to('all_color');
    }//End Function Admin Page

    public function show_color_home($color_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();
        $color_by_id = DB::table('tbl_product')->join('tbl_color','tbl_product.product_color','=','tbl_color.id')->where('tbl_product.product_color',$color_id)->get();
        $color_name = DB::table('tbl_color')->where('tbl_color.id',$color_id)->limit(1)->get();
        return view('pages.color.show_color')->with('category',$cate_product)->with('color',$color_product)->with('color_by_id',$color_by_id)->with('color_name',$color_name);
    }
}
