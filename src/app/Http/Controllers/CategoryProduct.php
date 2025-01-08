<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get(); 
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm Thành Công');
        return Redirect::to('all_categoryproduct');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Ẩn Thành Công');
        return Redirect::to('all_categoryproduct');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Hiển Thị Thành Công');
        return Redirect::to('all_categoryproduct');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('id',$category_product_id)->get(); 
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id',$category_product_id)->delete();
        Session::put('message','Xóa Thành Công');
        return Redirect::to('all_categoryproduct');
    }
    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('id',$category_product_id)->update($data);
        Session::put('message','Cập Nhật Thành Công');
        return Redirect::to('all_categoryproduct');
    }//End Function Admin Page

    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_product)->with('color',$color_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}