<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class ContactController extends Controller
{
    public function showContactForm()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('id','desc')->get();
        $color_product = DB::table('tbl_color')->where('color_status','1')->orderby('id','desc')->get();
        return view('pages.contact')->with('category',$cate_product)->with('color',$color_product);
    }

    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Mail::send([], [], function ($message) use ($request) {
            $message->to('caothuyvy13@gmail.com')
                ->subject('Liên hệ từ: ' . $request->name)
                ->setBody('<p>Email: ' . $request->email . '</p><p>Nội dung: ' . $request->message . '</p>', 'text/html');
        });

        return redirect()->back()->with('success', 'Liên hệ của bạn đã được gửi thành công!');
    }
}
