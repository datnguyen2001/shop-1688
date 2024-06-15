@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                             role="alert">
                            {{session('error')}}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif
                        <form method="post" action="{{url('admin/product/update/'.$product->id)}}"
                              enctype="multipart/form-data" class="card p-3">
                        @csrf
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Tên sản phẩm</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="name" value="{{$product->name}}" required>
                            </div>
                        </div>
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Mã sản phẩm</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="code" value="{{$product->code}}" required>
                            </div>
                        </div>
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Giá bán</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control price format-currency" name="price" value="{{$product->price}}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0">Danh mục :</p>
                            </div>
                            <div class="col-9">
                                <div class="row m-0 border">
                                    <div class="col-lg-4 pt-2 pb-2"
                                         style="border-right: 1px solid #dddddd; overflow: auto; max-height: 400px">
                                        @foreach($category_all as $key => $cate)
                                            <div class="d-flex align-items-center category p-1">
                                                <div class="d-flex align-items-center" style="margin-right: 10px">
                                                    <input type="radio" style="width: 20px; height: 20px" id="cate{{$key}}"
                                                           value="{{$cate->id}}" name="category" @if($cate_big->parent_id == $cate->id) checked @elseif($cate_big->id == $cate->id) checked @endif></div>
                                                <label for="cate{{$key}}" class="m-0">{{$cate->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div list_category_children class="col-lg-4 pb-2 pt-2"
                                         style="border-right: 1px solid #dddddd; overflow: auto; max-height: 400px">
                                        @foreach($category_child as $value)
                                            <div class="d-flex align-items-center category list_category_children p-1">
                                                <div class="d-flex align-items-center" style="margin-right: 10px">
                                                    <input type="radio" style="width: 20px; height: 20px"
                                                           value="{{$value->id}}"
                                                           @if($product->category_id == $value->id) checked
                                                           @endif name="category_children">
                                                </div>
                                                <p class="m-0">{{$value->name}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row mb-3">
                                <div class="col-3 d-flex align-items-center">
                                    <p class="m-0">Ảnh bìa sản phẩm :</p>
                                </div>
                                <div class="col-9">
                                    <div
                                        class="d-flex align-items-center position-relative selector__image justify-content-center"
                                        style="width: 200px; height: 250px; background: #f0f0f0;cursor: pointer">
                                        <img src="{{asset($product->src)}}" class="position-absolute w-100 h-100"
                                             style="top: 0;left: 0; object-fit: cover">
                                        <label class="position-absolute bg-transparent clear-img text-black"
                                               style="top: 5px; right: 5px; z-index: 10; cursor: pointer"><i
                                                class="bi bi-x-circle-fill"></i></label>
                                    </div>
                                    <input type="file" hidden name="file_product" accept="image/*">
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-header bg-info text-white">
                                    Hình ảnh sản phẩm
                                </div>
                                <div class="card-body">
                                    <div class="image-uploader image_product has-files mt-2">
                                        <div class="uploaded">
                                            @foreach($product_img as $value)
                                                <div class="uploaded-images">
                                                    <img src="{{asset($value->src)}}">
                                                    <button type="button" value="{{$value->id}}" class="delete__image"><i
                                                            class="bi bi-x"></i></button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                Cập nhật hình ảnh sản phẩm
                            </div>
                            <div class="card-body">
                                <label class="mt-2 mb-2"><i class="fa fa-upload"></i> Chọn hoặc kéo ảnh vào khung bên
                                    dưới</label>
                                <div class="input-image-product">
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true"
                               aria-controls="collapseExample1" class="btn bg-info text-white card-header">
                                <p class="d-flex align-items-center justify-content-between mb-0"><strong
                                        style="font-weight: unset">Thông tin sản phẩm</strong><i
                                        class="fa fa-angle-down"></i></p>
                            </a>
                            <div id="collapseExample1" class="collapse shadow-sm show">
                                <div class="card">
                                    <div class="card-body mt-2">
                                        <textarea name="content" id="content"
                                                  class="ckeditor">{!! $product->content !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Thêm màu sản phẩm
                            </div>
                            <div class="card-body card-body-color p-0 bg-white">
                                @foreach($product_color as $key => $item)
                                <div class="mt-3 border-bottom data-variant pb-3">
                                    <input value="{{$item->id}}" hidden name="variant[{{$key}}][attribute_id]">
                                    <div class="row m-0">
                                        <div class="col-lg-3 p-1">
                                            <input type="text" name="variant[{{$key}}][name]" class="form-control"
                                                   placeholder="Tên màu" value="{{$item->name}}" required>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <input type="file" class="form-control" name="variant[{{$key}}][src_color]" accept="image/*">
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <button type="button" class="btn btn-success btn-add-color form-control"><i
                                                    class="bi bi-plus-lg"></i> Thêm Màu
                                            </button>
                                        </div>
                                        @if($key > 0)
                                            <div class="col-lg-2 p-1">
                                                <a class="btn btn-danger btn-delete-name"
                                                   href="{{url('/admin/product/delete-color/'.$item->id)}}">
                                                    <i class="bi bi-trash"></i> Xóa</a>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                    @endforeach
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Trạng thái: </label>
                            <div class="col-sm-8">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="display" type="checkbox" @if($product->display == 1) checked @endif
                                           id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Hiện sản phẩm</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-success" style="margin-right: 15px">Cập nhật</button>
                            <button type="reset" class="btn btn-dark">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script src="{{url('assets/admin/js/input_file.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/js/format_currency.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/js/create_product.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height:'500px'
        });
    </script>
    <script>
        $('button.delete__image').confirm({
            title: 'Xác nhận!',
            content: 'Bạn có chắc chắn muốn xóa bản ghi này?',
            buttons: {
                ok: {
                    text: 'Xóa',
                    btnClass: 'btn-danger',
                    action: function(){
                        let data = {};
                        data['id'] = this.$target.attr("value");
                        $.ajax({
                            url: window.location.origin + '/admin/product/delete-img',
                            data: data,
                            dataType: 'json',
                            type: 'post',
                            success: function (data) {
                                if (data.status){
                                    location.reload();
                                }
                            }
                        });
                    }
                },
                close: {
                    text: 'Hủy',
                    action: function () {}
                }
            }
        });
        $('a.btn-delete-color').confirm({
            title: 'Xác nhận!',
            content: 'Bạn có chắc chắn muốn xóa bản ghi này?',
            buttons: {
                ok: {
                    text: 'Xóa',
                    btnClass: 'btn-danger',
                    action: function(){
                        location.href = this.$target.attr('href');
                    }
                },
                close: {
                    text: 'Hủy',
                    action: function () {}
                }
            }
        });
    </script>
@endsection
