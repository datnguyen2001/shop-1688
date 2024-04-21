@extends('web.index')
@section('title','Quên mật khẩu')

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
                    <ul class="breadcrumb" >
                        <li class="home"><a href="https://vuongphat1688.com/" title="Trang chủ"><span>Trang chủ</span></a>   </li>

                        <li><strong >Quên mật khẩu</strong></li>

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
                            <h1 class="title-head">Quên mật khẩu</h1>
                        </div>
                        <form accept-charset="UTF-8" action="" method="post" class="has-validation-callback">
                            <div class="form-signup">

                            </div>
                            <div class="form-signup clearfix">
                                <fieldset class="form-group margin-bottom-20">
                                    <label>Email<span class="required">*</span></label>
                                    <input placeholder="Nhập Địa chỉ Email" type="email" class="form-control form-control-lg" value="" name="email" id="login_email">
                                </fieldset>

                                <div class="pull-xs-left text-center" style="margin-top: 15px;">
                                    <button class="btn btn-style btn-blues" name="recovery" type="submit" value="Gửi">Gửi</button>
                                    <button class="btn btn-style btn-blues" id="loadingDiv">Loading...</button>

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
    <script>
        $("#loadingDiv").hide();
        $(document).ready(function () {
            $(document).ajaxStart(function () {
                $("#show_button").hide();
                $("#loadingDiv").show();
            }).ajaxStop(function () {
                $("#show_button").show();
                $("#loadingDiv").hide();
            });
        });
    </script>
@stop
