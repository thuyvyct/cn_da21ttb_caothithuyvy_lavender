@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Thêm Màu Sắc Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/save_color')}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputSize">Tên Màu Sắc</label>
                            <input type="text" name = "color_name" class="form-control" id="exampleInputSize" placeholder="Tên màu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatus">Trạng Thái</label>
                            <select name = "color_status" class="form-control m-bot15">
                                <option value = "1">Hiển Thị</option>
                                <option value = "0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name = "add_color" class="btn btn-info">Thêm</button><br><br>
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