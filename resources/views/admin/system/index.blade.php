@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hệ thống</h5>
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('admin.system.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="text" hidden value="{{@$data->id}}" name="system_id">
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên thương hiệu</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="brand_name" value="{{@$data->brand_name}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên công ty</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="company_name" value="{{@$data->company_name}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-3">Logo :</div>
                                    <div class="col-4">
                                        @if(@$data->logo)
                                            <div class="form-control position-relative div-parent" style="padding-top: 50%">
                                                <div class="position-absolute w-100 h-100 div-file" style="top: 0; left: 0;z-index: 10">
                                                    <button type="button" class="position-absolute clear border-0 bg-danger p-0 d-flex justify-content-center align-items-center" style="top: -10px;right: -10px;width: 30px;height: 30px;border-radius: 50%"><i class="bi bi-x-lg text-white"></i></button>
                                                    <img src="{{asset($data->logo)}}" class="w-100 h-100" style="object-fit: cover">
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
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address" value="{{@$data->address}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" value="{{@$data->phone}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" value="{{@$data->email}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="website" value="{{@$data->website}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="facebook" value="{{@$data->facebook}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại zalo</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="zalo" value="{{@$data->zalo}}" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Youtube</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="youtube" value="{{@$data->youtube}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Twitter</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="twitter" value="{{@$data->twitter}}" class="form-control">
                                    </div>
                                </div>
                                <input type="file" name="file" accept="image/x-png,image/gif,image/jpeg" hidden>
                                <div class="row mt-5">
                                    <div class="col-3"></div>
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-primary">Tạo</button>
                                        <a href="{{route('admin.system.index')}}" class="btn btn-danger">Hủy</a>
                                    </div>
                                </div>
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
