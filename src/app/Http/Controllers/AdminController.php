<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    } 
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password =md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('id',$result->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản không đúng. Vui lòng nhập lại!!!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('id', null);
        return Redirect::to('/admin');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm trong bảng sản phẩm
        $products = DB::table('tbl_product')
            ->where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('product_price', 'LIKE', "%{$query}%")
            ->get();

        // Tìm kiếm trong bảng khách hàng
        $customers = DB::table('tbl_customer')
            ->where('customer_name', 'LIKE', "%{$query}%")
            ->orWhere('customer_email', 'LIKE', "%{$query}%")
            ->get();

        // Tìm kiếm trong bảng đơn hàng
        $orders = DB::table('tbl_order')
            ->where('order_status', 'LIKE', "%{$query}%")
            ->orWhere('order_total', 'LIKE', "%{$query}%")
            ->get();

        return view('admin.search_results', compact('products', 'customers', 'orders', 'query'));
    }
}
