<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//CKEditor
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('upload.image');

//Frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang_chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');

//Danh mục sản phẩm
Route::get('/danh_muc_san_pham/{id}','App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/mau_san_pham/{id}','App\Http\Controllers\ColorController@show_color_home');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@details_product');

//Backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin_dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/admin/search', 'App\Http\Controllers\AdminController@search');


//Category Product
Route::get('/add_categoryproduct', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit_category_product/{id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete_category_product/{id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all_categoryproduct', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/active_category_product/{id}', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive_category_product/{id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');

Route::post('/save_category_product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update_category_product/{id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//Product
Route::get('/add_product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit_product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete_product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all_product', 'App\Http\Controllers\ProductController@all_product');

Route::get('/active_product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive_product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');

Route::post('/save_product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update_product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

//Size
Route::get('/add_size', 'App\Http\Controllers\SizeController@add_size');
Route::get('/edit_size/{id}', 'App\Http\Controllers\SizeController@edit_size');
Route::get('/delete_size/{id}', 'App\Http\Controllers\SizeController@delete_size');
Route::get('/all_size', 'App\Http\Controllers\SizeController@all_size');

Route::get('/active_size/{id}', 'App\Http\Controllers\SizeController@active_size');
Route::get('/unactive_size/{id}', 'App\Http\Controllers\SizeController@unactive_size');

Route::post('/save_size', 'App\Http\Controllers\SizeController@save_size');
Route::post('/update_size/{id}', 'App\Http\Controllers\SizeController@update_size');

//Color
Route::get('/add_color', 'App\Http\Controllers\ColorController@add_color');
Route::get('/edit_color/{id}', 'App\Http\Controllers\ColorController@edit_color');
Route::get('/delete_color/{id}', 'App\Http\Controllers\ColorController@delete_color');
Route::get('/all_color', 'App\Http\Controllers\ColorController@all_color');

Route::get('/active_color/{id}', 'App\Http\Controllers\ColorController@active_color');
Route::get('/unactive_color/{id}', 'App\Http\Controllers\ColorController@unactive_color');

Route::post('/save_color', 'App\Http\Controllers\ColorController@save_color');
Route::post('/update_color/{id}', 'App\Http\Controllers\ColorController@update_color');

//Image
Route::get('/add_image/{product_id}', 'App\Http\Controllers\ImageController@add_image');
Route::post('/select-image', 'App\Http\Controllers\ImageController@select_image');
Route::post('/insert-images/{product_id}', 'App\Http\Controllers\ImageController@insert_images');
Route::post('/delete-image', 'App\Http\Controllers\ImageController@delete_image');
Route::post('/update-image', 'App\Http\Controllers\ImageController@update_image');



//Cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show_cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::post('/add-to-cart', 'App\Http\Controllers\CartController@addToCart');


//Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');

//Order
Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
Route::get('/view-order/{order_id}', 'App\Http\Controllers\CheckoutController@view_order');

//Cong Thanh ToanToan
Route::get('/vnpay_payment', 'App\Http\Controllers\CheckoutController@paymentVNPay');
Route::get('/momo_payment', 'App\Http\Controllers\CheckoutController@momo_payment');
Route::get('/trang_chu','App\Http\Controllers\CheckoutController@handleMomoRedirect');

//Contact
Route::get('/contact', 'App\Http\Controllers\ContactController@showContactForm');
