@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Màu Sắc Sản Phẩm
                </header>
                <div class="panel-body">
                    @foreach($edit_color as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action = "{{URL::to('/update_color/'.$edit_value->id)}}" method = "post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputColor">Tên Màu Sắc</label>
                            <input type="text" value="{{$edit_value->color_name}}" name = "color_name" class="form-control" id="exampleInputSize">
                        </div>
                        <button type="submit" name = "update_color" class="btn btn-info">Cập Nhật</button><br><br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
</div>
@endsection