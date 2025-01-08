@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Thêm Danh Mục Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/save_category_product')}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputCategory">Tên Danh Mục</label>
                            <input type="text" name = "category_product_name" class="form-control" id="exampleInputCategory" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô Tả Danh Mục</label>
                            <textarea style ="resize: none" rows = "8" name = "category_product_desc" class="form-control" id="exampleInputDesc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng Thái</label>
                            <select name = "category_product_status" class="form-control m-bot15">
                                <option value = "1">Hiển Thị</option>
                                <option value = "0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name = "add_category_product" class="btn btn-info">Thêm</button><br><br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>

                    </form>
                    </div>
                </div>
            </section>

    </div>
@endsection