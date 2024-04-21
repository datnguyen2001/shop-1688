@extends('web.index')
@section('title','Thay đổi mật khẩu')

@section('style_page')

@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ  /</a></li>
                <li><a >Đổi mật khẩu</a></li>
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
                            <p class="date">Ngày tham gia: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }} </p>
                            <ul>
                                <li><a href="{{route('profile')}}" title="">Tài khoản của tôi<i class="fas fa-chevron-right"></i></a></li>
                                <li class="active"><a href="{{route('password')}}" title="">Đổi mật khẩu<i class="fas fa-chevron-right"></i></a></li>
                                <li><a href="{{route('my-order')}}" title="">Đơn mua<i class="fas fa-chevron-right"></i></a></li>
                                <li><a href="{{route('logout')}}" title="">Thoát<i class="fas fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <form  method="post" action="{{route('save-password')}}">
                        @csrf
                        <div class="main-admin main-change-passwword" style="padding: 10px">
                            <h3 class="title">Đổi mật khẩu</h3>
                            <div class="content-admin">
                                <div class="item">
                                    <div class="left">
                                        <label>Mật khẩu mới</label>
                                    </div>
                                    <div class="right">
                                        <input type="password" name="password" value=""  class="form-control"  placeholder="*********"   />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left">
                                        <label>Nhập lại mật khẩu mới</label>
                                    </div>
                                    <div class="right">
                                        <input type="password" name="password_two" value=""  class="form-control"  placeholder="*********"   />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item item1">
                                    <div class="left">
                                    </div>
                                    <div class="right" >
                                        <input type="submit"  name="save" value="Lưu lại">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@stop
@section('script_page')

@stop
