@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cập nhật người dùng</h5>
                            <!-- General Form Elements -->
                            @if (session('error'))
                                <div
                                    class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{session('error')}}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{url('admin/user/update/'.$user->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên tài khoản</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{$user->name}}" readonly
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Mật khẩu</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">Avatar :</div>
                                    <div class="col-4">
                                        @if(@$user->avatar)
                                            <div class="form-control position-relative div-parent" style="padding-top: 50%">
                                                <div class="position-absolute w-100 h-100 div-file" style="top: 0; left: 0;z-index: 10">
                                                    <button type="button" class="position-absolute clear border-0 bg-danger p-0 d-flex justify-content-center align-items-center" style="top: -10px;right: -10px;width: 30px;height: 30px;border-radius: 50%"><i class="bi bi-x-lg text-white"></i></button>
                                                    <img src="{{asset($user->avatar)}}" class="w-100 h-100" style="object-fit: cover">
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-control position-relative" style="padding-top: 50%">
                                                <button type="button" class="position-absolute border-0 bg-transparent select-image" style="top: 50%;left: 50%;transform: translate(-50%,-50%)">
                                                    <i style="font-size: 30px" class="bi bi-download"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên zalo</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name_zalo" value="{{$user->name_zalo}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại zalo</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone_zalo" value="{{$user->phone_zalo}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên người nhận hàng</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="consignee_name" value="{{$user->consignee_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại người nhận hàng</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="consignee_phone" value="{{$user->consignee_phone}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Địa chỉ nhận hàng</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="consignee_address" value="{{$user->consignee_address}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">Khóa tài khoản :</div>
                                    <div class="col-8">
                                        <label class="switch form-check form-switch">
                                            <input type="checkbox" class="form-check-input" @if($user->is_active == 0) checked
                                                   @endif name="is_active">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-5">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                                        <a href="{{route('admin.user.index')}}" class="btn btn-danger">Hủy</a>
                                    </div>
                                </div>
                                <input type="file" name="file" accept="image/x-png,image/gif,image/jpeg" hidden>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        let parent;
        $(document).on("click", ".select-image", function () {
            $('input[name="file"]').click();
            parent = $(this).parent();
        });
        $('input[type="file"]').change(function(e){
            imgPreview(this);
        });
        function imgPreview(input) {
            let file = input.files[0];
            let mixedfile = file['type'].split("/");
            let filetype = mixedfile[0]; // (image, video)
            if(filetype == "image"){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#preview-img").show().attr("src", );
                    let html = '<div class="position-absolute w-100 h-100 div-file" style="top: 0; left: 0;z-index: 10">' +
                        '<button type="button" class="position-absolute clear border-0 bg-danger p-0 d-flex justify-content-center align-items-center" style="top: -10px;right: -10px;width: 30px;height: 30px;border-radius: 50%"><i class="bi bi-x-lg text-white"></i></button>'+
                        '<img src="'+e.target.result+'" class="w-100 h-100" style="object-fit: cover">' +
                        '</div>';
                    parent.html(html);
                }
                reader.readAsDataURL(input.files[0]);
            }else if(filetype == "video" || filetype == "mp4"){
                let html = '<div class="position-absolute w-100 h-100 div-file" style="top: 0; left: 0;z-index: 10">' +
                    '<button type="button" class="position-absolute clear border-0 bg-danger p-0 d-flex justify-content-center align-items-center" style="top: -10px;right: -10px;width: 30px;height: 30px;border-radius: 50%;z-index: 14"><i class="bi bi-x-lg text-white"></i></button>'+
                    '<video class="w-100 h-100" style="object-fit: cover" controls>\n' +
                    '<source src="'+URL.createObjectURL(input.files[0])+'"></video>'+
                    '</div>';
                parent.html(html);
            }else{
                alert("Invalid file type");
            }
        }
        $(document).on("click", "button.clear", function () {
            parent = $(this).closest(".div-parent");
            $(".div-file").remove();
            let html = '<button type="button" class="position-absolute border-0 bg-transparent select-image" style="top: 50%;left: 50%;transform: translate(-50%,-50%)">\n' +
                '                                    <i style="font-size: 30px" class="bi bi-download"></i>\n' +
                '                                </button>';
            parent.html(html);
            $('input[type="file"]').val("");
        });
    </script>
@endsection
