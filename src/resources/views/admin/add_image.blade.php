@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="font-size: 25px;">
                    Thêm Thư Viện Ảnh
                </header>
                
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                    <form action="{{URL('/insert-images/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3" align="right">

                        </div>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                            <span id="error_gallery"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="upload" name="taianh" value="Tải Ảnh" class="btn btn-success">
                        </div>
                    </div>
                    </form>

                    <div class="panel-body">
                        <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                        <form>  
                            @csrf
                            <div id="image_load">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thứ Tự</th>
                                            <th>Tên Hình Ảnh</th>
                                            <th>Hình Ảnh</th>
                                            <th>Quản Lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($images) && $images->count() > 0)
                                        @foreach ($images as $key => $img)
                                        <tr id="image-row-{{ $img->image_id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <input type="text" value="{{ $img->image_name }}" 
                                                       class="form-control image-name" data-img_id="{{ $img->image_id }}">
                                            </td>
                                            <td>
                                                <img src="{{ url('public/uploads/gallery/' . $img->image_img) }}" 
                                                     class="img-thumbnail" height="100" width="100">
                                            </td>
                                            <td>
                                                <button type="button" data-img_id="{{ $img->image_id }}" 
                                                        class="btn btn-xs btn-danger delete-image">Xóa</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Sản phẩm chưa có thư viện ảnh</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>                    
            </section>
    </div>
@endsection