@extends('admin_layout')
@section('admin_content')

<h3 style="color: black;">Kết quả tìm kiếm cho từ: "{{ $query }}"</h3>

@if($products->isEmpty() && $customers->isEmpty() && $orders->isEmpty())
    <p style="color: black;">Không tìm thấy kết quả nào.</p>
@else
    <!-- Kết quả tìm kiếm sản phẩm -->
    @if(!$products->isEmpty())<br>
    <h4 style="color: black;">Sản Phẩm:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="color: black;">Ảnh sản phẩm</th>
                <th style="color: black;">Tên sản phẩm</th>
                <th style="color: black;">Giá</th>
                <th style="color: black;">Danh mục</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><img src="{{ asset('/public/uploads/product/' . $product->product_image) }}" style="height: 140px; width: 100px;"></td>
                <td style="color: black;">{{ $product->product_name }}</td>
                <td style="color: black;">{{ number_format($product->product_price, 0, ',', '.') }} VND</td>
                <td style="color: black;">{{ $product->category_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Kết quả tìm kiếm khách hàng -->
    @if(!$customers->isEmpty())
    <h4 style="color: black;">Khách hàng:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="color: black;">Tên khách hàng</th>
                <th style="color: black;">Email</th>
                <th style="color: black;">Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td style="color: black;">{{ $customer->customer_name }}</td>
                <td style="color: black;">{{ $customer->customer_email }}</td>
                <td style="color: black;">{{ $customer->customer_phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Kết quả tìm kiếm đơn hàng -->
    @if(!$orders->isEmpty())
    <h4 style="color: black;">Đơn hàng</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="color: black;">Mã đơn hàng</th>
                <th style="color: black;">Tổng tiền</th>
                <th style="color: black;">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="color: black;">{{ $order->id }}</td>
                <td style="color: black;">{{ number_format($order->order_total, 0, ',', '.') }} VND</td>
                <td style="color: black;">{{ $order->order_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endif

@endsection
