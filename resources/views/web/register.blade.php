@extends('web.index')
@section('title','Đăng ký thành viên')

@section('style_page')
    <style>
        .btn-register-login {
            display: block;
            margin-bottom: 0;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 1.2px;
            color: #f68e2e;
            margin-top: 10px;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb" >
                        <li class="home"><a href="{{route('home')}}" title="Trang chủ"><span >Trang chủ</span></a></li>
                        <li><strong >Đăng ký tài khoản</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container margin-bottom-20 margin-top-30">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-login account-box-shadow">
                    <div id="login">
                        <h1 class="title-head text-center margin-bottom-30">Đăng ký tài khoản</h1>
                        <form action="{{route('registered')}}" id="customer_register" method="post" class="has-validation-callback">
                            @csrf
                            <div class="form-signup clearfix">
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label>Tên đăng nhập<span class="required">*</span></label>
                                            <input placeholder="Tên đăng nhập" type="text" class="form-control form-control-lg" required value="" name="name" id="reg_email" >
                                        </fieldset>
                                    </div>


                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>Mật khẩu<span class="required">*</span></label>
                                            <input placeholder="Nhập Mật khẩu" type="password" class="form-control form-control-lg" required value="" name="password" id="reg_password"  >
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>Nhập lại mật khẩu<span class="required">*</span></label>
                                            <input placeholder="Nhập lại mật khẩu" type="password" class="form-control form-control-lg" value="" required name="password_two" id="reg_password_nhaplai"  >
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>Tên zalo <span class="required">*</span></label>
                                            <input placeholder="Tên zalo" type="text" class="form-control form-control-lg" value="" required name="zalofullname" id="reg_zalofullname"  >
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>Số điện thoại Zalo<span class="required">*</span></label>
                                            <input placeholder="Nhập Số điện thoại" type="tel" class="number-sidebar form-control form-control-lg" required name="phone_zalo" id="reg_phone"  >
                                        </fieldset>
                                    </div>

                                    <h1 class="title-head text-center margin-bottom-30" style="margin-top: 40px">Thông tin nhận hàng</h1>

                                    <div class="col-md-6 ">
                                        <fieldset class="form-group">
                                            <label>Họ và tên<span class="required">*</span></label>
                                            <input placeholder="Nhập Họ và tên" type="text" class="form-control form-control-lg" required name="fullname" id="reg_fullname"  >
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6 ">
                                        <fieldset class="form-group">
                                            <label>Số điện thoại<span class="required">*</span></label>
                                            <input placeholder="Nhập Số điện thoại" type="tel" class="number-sidebar form-control form-control-lg" required name="phone" id="reg_phone"  >
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label>Địa chỉ<span class="required">*</span></label>
                                            <input placeholder="Nhập địa chỉ" type="text" class="number-sidebar form-control form-control-lg" required name="address" id="reg_address"  >
                                        </fieldset>
                                    </div>

                                    <div class="col-md-12 text-center" style="margin-top:15px;">
                                        <button type="submit" value="Đăng ký" class="btn btn-style btn-blues" id="show_button">Tạo tài khoản</button>
                                        <a href="{{route('login')}}" title="Đăng nhập" class="btn btn-register btn-register-login">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script_page')

@stop
