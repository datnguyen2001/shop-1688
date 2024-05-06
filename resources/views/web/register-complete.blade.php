@extends('web.index')
@section('title','Đăng ký thành công')

@section('style_page')

@stop
{{--content of page--}}
@section('content')

    <section class="top-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="item-category">
                        <h2 class="title-category" style="text-transform: uppercase">Đăng ký thành công</h2>

                        <div class="nav-item-category" style="text-align: center">
                            <p><p>Đăng ký tài khoản thành công, liên hệ zalo <span><a href="https://zalo.me/{{@$system->phone}}" style="font-size: 17px; color: red;">{{@$system->phone}}</a></span>&nbsp;để được duyệt tài khoản ngay!</p>
                            </p>

                            <a href="https://zalo.me/{{@$system->phone}}" target="_blank"><img src="{{asset('assets/images/icon5.png')}}" alt=""></a>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

@stop
@section('script_page')

@stop
