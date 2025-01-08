<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use File;
use App\Models\Images;  
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('id','desc')->get();
        $size_product = DB::table('tbl_size')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->orderby('id','desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)
        ->with('size_product',$size_product)->with('color_product',$color_product);
        
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')->get(); 
        return view('admin.all_product')->with('all_product', $all_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['product_color'] = $request->product_color;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);     
        // // // Lưu thông tin size và số lượng
        // // if($request->has('size')) {
        // //     foreach($request->size as $size_id => $size_data) {
        // //         if(isset($size_data['selected']) && $size_data['selected'] == 1) {
        // //             DB::table('tbl_product_size')->insert([
        // //                     'product_id' => $product_id,
        // //                     'size_id' => $size_id
        // //                 ]);
        // //             }
        // //         }
        // //     }
        //         // Lưu kích thước cho sản phẩm
        //         if($request->has('product_size')) {
        //             foreach($request->product_size as $size_id) {
        //                 DB::table('product_sizes')->insert([
        //                     'product_id' => $pro_id,
        //                     'size_id' => $size_id
        //                 ]);
        //             }
        //         }

        $gallery = new Images();
        $gallery->image_img = $new_image;
        $gallery->image_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm Sản Phẩm Thành Công');
        return Redirect::to('all_product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn Thành Công');
        return Redirect::to('all_product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiển Thị Thành Công');
        return Redirect::to('all_product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('id','desc')->get();
        $size_product = DB::table('tbl_size')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->orderby('id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get(); 
        return view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('size_product',$size_product)->with('color_product',$color_product);
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa Thành Công');
        return Redirect::to('all_product');
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['product_color'] = $request->product_color;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product/',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập Nhật Thành Công');
            return Redirect::to('all_product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập Nhật Thành Công');
        return Redirect::to('all_product');
    }//End Admin Page

    public function details_product( $product_id){
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.id', '=', 'tbl_product.category_id')
        ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product.product_color')
        ->where('tbl_product.product_id', $product_id)
        ->select(
            'tbl_product.product_id as product_id',          // ID của sản phẩm
            'tbl_product.product_name',
            'tbl_product.product_price',
            'tbl_product.product_image',
            'tbl_product.product_desc',
            'tbl_category_product.id as category_id', // ID của danh mục
            'tbl_category_product.category_name',
            'tbl_color.color_name'
        )->get();

        $sizes = DB::table('tbl_product_size')
        ->join('tbl_size', 'tbl_product_size.size_id', '=', 'tbl_size.id')
        ->where('tbl_product_size.product_id', $product_id)
        ->select('tbl_size.size_name')
        ->get();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();
        foreach($details_product as $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
        }
        $gallery = Images::where('product_id',$product_id)->get();
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.id', '=', 'tbl_product.category_id')
        ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product.product_color')
        ->where('tbl_category_product.id', $category_id)->whereNotIn('tbl_product.product_id',[$product_id])->limit(4)->get();
        return view('pages.product.show_detailsproduct')->with('product_details',$details_product)
        ->with('category',$cate_product)->with('color',$color_product)->with('relate',$related_product)->with('gallery',$gallery)->with('sizes',$sizes);
    }
}
