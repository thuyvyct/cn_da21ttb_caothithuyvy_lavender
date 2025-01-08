<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function gio_hang(Request $request){
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng Ajax";
        $meta_title = "Giỏ Hàng Ajax";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('color',$color_product)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id =substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key -> $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable = 0){
                $cart[$key] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[$key] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
            );
        }
        Session::put('cart',$cart);
        Session::save();
    }
    
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productImage = $request->input('product_image');
        $productPrice = $request->input('product_price');
        $productQty = $request->input('product_qty');
    
        // Thêm sản phẩm vào giỏ hàng
        Cart::add([
            'id' => $productId,
            'name' => $productName,
            'qty' => $productQty,
            'price' => $productPrice,
            'options' => ['image' => $productImage],
        ]);
    
        return response()->json(['success' => 'Sản phẩm đã được thêm vào giỏ hàng!']);
    }    

    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        // $sizes = $request->size;

        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 

        // if (!$size) {
        //     return Redirect::to('/product-detail/' . $productId)
        //         ->with('error', 'Vui lòng chọn kích cỡ sản phẩm.');
        // }

        // Cart::add('293ad', 'Product 1', 1, 9.99);

        $data['id'] = $product_info->product_id; 
        $data['qty'] = $quantity;
        // $data['size'] = $size;  
        $data['name'] = $product_info->product_name; 
        $data['price'] = $product_info->product_price;  
        $data['options'] ['image'] = $product_info->product_image; 
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show_cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('color',$color_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show_cart');
    }
}
