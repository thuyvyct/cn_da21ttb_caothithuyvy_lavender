<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }   
    }

    public function execPostRequest($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
    }

    public function view_order($orderId){  
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first(); 
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);    
    }
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('color',$color_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('color',$color_product);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('color',$color_product);
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');   
        }else{
            return Redirect::to('/login-checkout');
        }
    }
    public function order_place(Request $request){
        //Insert Payment Method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //Insert Order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //Insert Order Details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            return $this->momo_payment($order_id, Cart::total());

        }elseif($data['payment_method']==2){
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
            $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('color',$color_product);

        }else{
            return $this->paymentVNPay($order_id, Cart::total());
        }
    }
    public function paymentVNPay($order_id, $total_amount)
{
    $vnp_TmnCode = "93NJCQEN";
    $vnp_HashSecret = "5b3fb0266f40232ed04a8628083c3683"; 
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/lavender/trang_chu";

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $total_amount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => request()->ip(),
        "vnp_Locale" => "vn",
        "vnp_OrderInfo" => "Thanh toan don hang " . $order_id,
        "vnp_OrderType" => "billpayment",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $order_id
    );

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

    return redirect($vnp_Url);
}
    public function paymentReturn(Request $request){
    // Kiểm tra mã giao dịch từ VNPay
    if ($request->vnp_ResponseCode == "00") {
        // Thanh toán thành công
        DB::table('tbl_payment')->where('payment_id', $request->vnp_TxnRef)
            ->update(['payment_status' => 'Thanh toán thành công']);

        // Cập nhật trạng thái đơn hàng
        DB::table('tbl_order')->where('order_id', $request->vnp_TxnRef)
            ->update(['order_status' => 'Đã thanh toán']);

        // Trả kết quả thanh toán thành công
        return view('payment_success')->with('message', 'Thanh toán thành công!');
    } else {
        // Thanh toán thất bại
        return view('payment_failed')->with('message', 'Thanh toán không thành công!');
    }
    }
    public function momo_payment()
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    
        // Lấy tổng giá trị giỏ hàng
        $amount = Cart::total();  // Lấy tổng giá trị giỏ hàng
        $amount = str_replace(',', '', $amount);  // Xóa dấu phẩy (nếu có) để sử dụng làm số nguyên
        $amount = intval($amount);  // Chuyển đổi thành số nguyên
    
        // Kiểm tra nếu giỏ hàng rỗng hoặc giá trị không hợp lệ
        if ($amount <= 0) {
            return redirect('/cart')->with('error', 'Giỏ hàng trống hoặc có lỗi, vui lòng kiểm tra lại.');
        }
    
        // Các thông tin cần thiết
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $orderId = time() . "";  // Mã đơn hàng, có thể sử dụng thời gian hiện tại
        $redirectUrl = "http://localhost/lavender/trang_chu";

        $ipnUrl = "http://localhost/lavender/trang_chu";
        $extraData = "";  // Dữ liệu bổ sung (nếu có)
    
        $requestId = time() . "";
        $requestType = "payWithATM";
    
        // Tạo chuỗi để ký HMAC SHA256
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
    
        // Tạo dữ liệu gửi tới MoMo
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
    
        // Gửi yêu cầu tới MoMo API
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // Giải mã JSON từ phản hồi của API
    
        // Kiểm tra nếu phản hồi thành công và có "payUrl"
        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']); // Chuyển hướng tới trang thanh toán của MoMo
        } else {
            return redirect('/checkout')->with('error', 'Không thể tạo yêu cầu thanh toán MoMo, vui lòng thử lại.');
        }
    }
    public function handleMomoRedirect(Request $request){
        // Nhận thông tin trả về từ MoMo
        $resultCode = $request->input('resultCode');
        $message = $request->input('message');

        if ($resultCode == 0) {
            // Thanh toán thành công
            // Hủy giỏ hàng
            Cart::destroy();

            // Hiển thị thông báo thành công và chuyển hướng
            return redirect('/trang-chu')->with('success', 'Thanh toán thành công. Giỏ hàng đã được hủy!');
        } else {
            // Thanh toán thất bại
            return redirect('/checkout')->with('error', 'Thanh toán thất bại: ' . $message);
        }
    }

    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')->orderby('tbl_order.order_id','desc')->get(); 
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
}
