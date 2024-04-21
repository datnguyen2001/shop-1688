@extends('web.index')
@section('title','Thông tin tài khoản')

@section('style_page')
    <style>
        .avarta {
            cursor: pointer;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div id="main" class="wrapper">
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{route('home')}}">Trang chủ /</a></li>
                    <li><a>Thông tin tài khoản</a></li>
                </ul>
            </div>
        </div>
        <div class="main-child">
            <div class="container container1000">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-13">
                        <div class="sidebar">
                            <div class="sidebar-admin">
                                <div class="avarta">
                                    @if($user->avatar)
                                        <img src="{{asset($user->avatar)}}">
                                    @else
                                        <img src="{{asset('assets/images/ll.png')}}">
                                    @endif
                                </div>
                                <h3 class="title-name"></h3>

                                <p class="date">Ngày tham
                                    gia: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
                                <ul>
                                    <li class="active"><a href="{{route('profile')}}">Tài khoản của tôi<i
                                                class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="{{route('password')}}">Đổi mật khẩu<i class="fas fa-chevron-right"></i></a>
                                    </li>
                                    <li><a href="{{route('my-order')}}">Đơn mua<i class="fas fa-chevron-right"></i></a>
                                    </li>
                                    <li><a href="{{route('logout')}}">Thoát<i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="main-admin" style="padding: 10px">
                            <h3 class="title">Tài khoản của tôi</h3>

                            <div class="content-admin">
                                <form class="form-horizontal" method="post" action="{{route('save-profile')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            <label>Tên tài khoản</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <label
                                                    style="width: 100%;"><input type="text" name="name"
                                                                                value="{{$user->name}}"
                                                                                class="form-control" readonly/>
                                                </label>
                                            </div>

                                            <div class="clearfix"></div>


                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            <label>Ảnh đại diện</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <div class="avarta change-avatar">
                                                    @if($user->avatar)
                                                        <img
                                                            src="{{asset($user->avatar)}}"
                                                            class="img-thumbnail"
                                                            alt=""
                                                            style="width: 103px;height: 103px;border-radius:100% ">
                                                    @else
                                                        <img
                                                            src="{{asset('assets/images/ll.png')}}"
                                                            class="img-thumbnail"
                                                            alt=""
                                                            style="width: 103px;height: 103px;border-radius:100% ">
                                                    @endif
                                                </div>
                                                <input type="file" style="display: none" class="img-avatar"
                                                       name="avatar"/>
                                            </div>


                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            <label>Tên ZALO</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <input type="text" name="zalofullname" value="{{$user->name_zalo}}"
                                                       class="form-control" required/>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="item" style="padding-bottom: 30px">
                                        <div class="left">
                                            <label>Số điện thoại ZALO</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <input type="text" name="phone_zalo" value="{{$user->phone_zalo}}"
                                                       class="form-control"
                                                       required/>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <h3 class="title">Thông tin nhận hàng</h3>
                                    <div class="item">
                                        <div class="left">
                                            <label>Họ và tên</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <input type="text" name="fullname" value="{{$user->consignee_name}}"
                                                       class="form-control"
                                                       required/>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            <label>Địa chỉ</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <input type="text" name="address" value="{{$user->consignee_address}}"
                                                       class="form-control"
                                                       required/>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="item">
                                        <div class="left">
                                            <label>Điện thoại</label>
                                        </div>
                                        <div class="right">
                                            <div class="right1">
                                                <input type="text" name="phone" value="{{$user->consignee_phone}}"
                                                       class="form-control"
                                                       required/>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="item">
                                        <div class="right">
                                            <input type="submit" class="btn btn-danger" name="update"
                                                   value=" Lưu lại ">
                                        </div>


                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


@stop
@section('script_page')
    <script type="text/javascript">
        $(document).on('click', '.change-avatar', function () {
            $('input[name="avatar"]').click();
        });

        $('input[name="avatar"]').change(function (e) {
            console.log(123)
            var reader = new FileReader();
            reader.onload = function () {
                var img = '<img src="' + reader.result + '" class="img-thumbnail" style="width: 103px;height: 103px;border-radius:100% "/>';
                $(".change-avatar").html(img);
            };
            reader.readAsDataURL(event.target.files[0]);
        });

    </script>
@stop
