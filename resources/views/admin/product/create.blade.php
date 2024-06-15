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
                    <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data"
                          class="card p-3">
                        @csrf
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Tên sản phẩm</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="name" value="{{old('name')}}" required>
                            </div>
                        </div>
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Mã sản phẩm</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control" name="code" value="{{old('code')}}" required>
                            </div>
                        </div>
                        <div class="row mb-3 box_parameter_2">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0 parameter_2">Giá bán</p>
                            </div>
                            <div class="col-9">
                                <input class="form-control price format-currency" value="{{old('price')}}" name="price" required>
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
                                        @foreach($category as $key => $cate)
                                        <div class="d-flex align-items-center category p-1">
                                            <div class="d-flex align-items-center" style="margin-right: 10px">
                                                <input type="radio" style="width: 20px; height: 20px" id="cate{{$key}}"
                                                       value="{{$cate->id}}" name="category"></div>
                                            <label for="cate{{$key}}" class="m-0">{{$cate->name}}</label>
                                        </div>
                                            @endforeach
                                    </div>
                                    <div list_category_children class="col-lg-4 pb-2 pt-2"
                                         style="border-right: 1px solid #dddddd; overflow: auto; max-height: 400px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 d-flex align-items-center">
                                <p class="m-0">Ảnh bìa sản phẩm (<span style="color: red"> * </span>) :</p>
                            </div>
                            <div class="col-9">
                                <div class="d-flex align-items-center selector__image justify-content-center"
                                     style="width: 200px; height: 250px; background: #f0f0f0;cursor: pointer">
                                    <img src="{{asset('assets/images/camera.png')}}">
                                </div>
                                <input type="file" hidden name="file_product" accept="image/*">
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                Hình ảnh sản phẩm
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
                                                  class="ckeditor">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Thêm màu sản phẩm
                            </div>
                            <div class="card-body card-body-color p-0 bg-white">
                                <div class="mt-3 border-bottom data-variant pb-3">
                                    <div class="row m-0">
                                        <div class="col-lg-3 p-1">
                                            <input type="text" name="variant[0][name]"  class="form-control"
                                                   placeholder="Tên màu" required>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <input type="file" class="form-control" name="variant[0][src_color]" accept="image/*" required>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <button type="button" class="btn btn-success btn-add-color form-control"><i
                                                    class="bi bi-plus-lg"></i> Thêm Màu
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Trạng thái: </label>
                            <div class="col-sm-8">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="display" type="checkbox" checked
                                           id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Hiện sản phẩm</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-success" style="margin-right: 15px">Tạo mới</button>
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
@endsection
