<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Images;
use Illuminate\Support\Facades\Redirect;
session_start();

class ImageController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }

    public function add_image($product_id){
        $pro_id = $product_id;
        $images = Images::where('product_id', $product_id)->get();

        return view('admin.add_image')->with(compact('pro_id', 'images'));
        // return view('admin.add_image')->with(compact('pro_id'));
    }

    public function insert_images(Request $request, $pro_id){
        $get_image = $request->file('file');
        if ($get_image) {
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery/',$new_image);
                $img = new Images();
                $img->image_name = $new_image;  
                $img->image_img = $new_image;
                $img->product_id = $pro_id; 
                $img->save();
                
            }
        } else {
            # code...
        }
        Session::put('message','Thêm Thư Viện Ảnh Thành Công');
        return Redirect()->back();
        
    }

    // public function select_image(Request $request)
    // {
    //     $product_id = $request->pro_id;
    //     // Lấy danh sách hình ảnh theo product_id
    //     $images = Images::where('product_id', $product_id)->get();
    //     // Khởi tạo bảng
    //     $output = '
    //         <table class="table table-hover table-bordered">
    //             <thead>
    //                 <tr>
    //                     <th>Thứ Tự</th>
    //                     <th>Tên Hình Ảnh</th>
    //                     <th>Hình Ảnh</th>
    //                     <th>Quản Lý</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';
    //     // Nếu có dữ liệu, hiển thị các hình ảnh
    //     if ($images->count() > 0) {
    //         $i = 1;
    //         foreach ($images as $img) {
    //             $output .= '
    //                 <tr>
    //                     <td>' . $i++ . '</td>
    //                     <td>' . $img->image_name . '</td>
    //                     <td>
    //                         <img src="' . url('public/uploads/gallery/' . $img->image_img) . '" 
    //                              class="img-thumbnail" height="100" width="100">
    //                     </td>
    //                     <td>
    //                         <button data-img_id="' . $img->id . '" 
    //                                 class="btn btn-xs btn-danger delete-image">Xóa</button>
    //                     </td>
    //                 </tr>';
    //         }
    //     } else {
    //         // Không có dữ liệu
    //         $output .= '
    //             <tr>
    //                 <td colspan="4" class="text-center">Sản phẩm chưa có thư viện ảnh</td>
    //             </tr>';
    //     }
    
    //     // Kết thúc bảng
    //     $output .= '
    //             </tbody>
    //         </table>';
    
    //     // Trả kết quả
    //     echo $output;
    // }
    

    public function all_image(){
        $all_image = DB::table('tbl_image')->get(); 
        return view('admin.all_image')->with('all_image', $all_image);
    }
    public function save_image(Request $request){
        $data = array();
        $data['image_name'] = $request->image_name;
        $data['image_path'] = $request->image_path;
        $data['image_caption'] = $request->image_caption;
        $get_image = $request->file('image_img');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product/',$new_image);
            $data['image_img'] = $new_image;
            DB::table('tbl_image')->insert($data);
            Session::put('message','Thêm Hình Ảnh Thành Công');
            return Redirect::to('all_image');
        }
        $data['image_img'] = '';
        DB::table('tbl_image')->insert($data);
        Session::put('message','Thêm Thành Công');
        return Redirect::to('all_image');
    }
    public function edit_image($image_id){
        $edit_image = DB::table('tbl_image')->where('id',$image_id)->get(); 
        return view('admin.edit_image')->with('edit_image', $edit_image);
    }

    public function delete_image($image_id){
        $this->AuthLogin();
        DB::table('tbl_image')->where('image_id',$image_id)->delete();
        Session::put('message','Xóa Thành Công');
        return Redirect::to('add_image');
    }

    // public function delete_image(Request $request){
    // $image_id = $request->image_id;
    // $image = Images::find($image_id);

    // if ($image) {
    //     $image_path = public_path('uploads/gallery/' . $image->image_img);
    //     // Xóa file hình ảnh từ thư mục
    //     if (file_exists($image_path)) {
    //         unlink($image_path);
    //     }
    //     // Xóa bản ghi trong cơ sở dữ liệu
    //     $image->delete();
    //     return response()->json(['success' => 'Xóa hình ảnh thành công']);
    //     }
    // return response()->json(['error' => 'Không tìm thấy hình ảnh']);
    // }
    public function update_image(Request $request){
    $image_id = $request->image_id;
    $new_name = $request->new_name;
    $image = Images::find($image_id);
    if ($image) {
        $image->image_name = $new_name;
        $image->save();
        return response()->json(['success' => 'Cập nhật hình ảnh thành công']);
    }
    return response()->json(['error' => 'Không tìm thấy hình ảnh']);
    }

}
