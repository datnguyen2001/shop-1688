@extends('web.index')
@section('title','Đăng nhập')

@section('style_page')
    <style>
        #show_flashdata_frontend{
            display: none;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">
                        <li class="home"><a href="{{route('home')}}/" title="Trang chủ"><span >Trang chủ</span></a>   </li>
                        <li><strong >Đăng nhập tài khoản</strong></li>
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
                        <div class="text-center margin-bottom-30">
                            <h1 class="title-head">Đăng nhập tài khoản</h1>
                        </div>
                        <form action="{{route('doLogin')}}" id="customer_login" method="post" class="has-validation-callback">
                            @csrf
                            <div class="form-signup clearfix">
                                <fieldset class="form-group margin-bottom-20">
                                    <label>Tên đăng nhập<span class="required">*</span></label>
                                    <input placeholder="Tên đăng nhập" type="text" class="form-control form-control-lg" required name="name" id="login_email">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Mật khẩu<span class="required">*</span></label>
                                    <input autocomplete="off" placeholder="Nhập Mật khẩu" type="password" class="form-control form-control-lg" required name="password" id="login_password">
                                </fieldset>
                                <div class="pull-xs-left text-center" style="margin-top: 15px;">
                                    <button class="btn btn-style btn-blues" name="" type="submit" value="Đăng nhập">Đăng nhập</button>
                                </div>
                                <div class="clearfix"></div>
{{--                                <p class="text-center">--}}
{{--                                    <a href="{{route('recovery')}}" class="btn-link-style" title="Quên mật khẩu?">Quên mật khẩu?</a>--}}
{{--                                </p>--}}

                                <div class="text-login text-center">
                                    <p>
                                        Bạn chưa có tài khoản. Đăng ký <a href="{{route('register')}}" title="Đăng ký">tại đây.</a>
                                    </p>
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
