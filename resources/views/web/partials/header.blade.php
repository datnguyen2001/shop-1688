<div id="show-script-body">
</div>
<header id="header-site">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="top-header-left">
                        <p>Chào mừng quý khách đến với {{@$system->brand_name}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="top-header-right">
                        <ul>
                            @if(\Illuminate\Support\Facades\Auth::user())
                                <li><a href="{{route('profile')}}"><img src="{{asset('assets/images/icon1.png')}}"
                                                                        alt="">{{\Illuminate\Support\Facades\Auth::user()->name}}
                                    </a></li>
                                <li><a href="{{route('logout')}}"><img src="{{asset('assets/images/icon2.png')}}"
                                                                       alt="Đăng nhập">Đăng xuất</a></li>
                            @else
                                <li><a href="{{route('register')}}"><img src="{{asset('assets/images/icon1.png')}}"
                                                                         alt="Đăng ký">Đăng ký</a></li>
                                <li><a href="{{route('login')}}"><img src="{{asset('assets/images/icon2.png')}}"
                                                                      alt="Đăng nhập">Đăng nhập</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="logo-search">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 header-logo-mobile">
                    <!-- begin mobile -->
                    <div class="wrapper cf">
                        <nav id="main-nav">
                            <ul class="second-nav">
                                <li class="devices  ">
                                    <a href="{{route('home')}}">Trang chủ</a>
                                </li>
                                @if(isset($header) && count($header) > 0)
                                    @foreach($header as $headers)
                                    <li class="devices ">
                                        <a href="{{route('blog',$headers->slug)}}" title="{{$headers->name}}">{{$headers->name}}</a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </nav>

                        <a class="toggle">
                            <span></span>
                        </a>

                    </div>
                    <!-- end mobile -->
                    <a href="{{route('home')}}" class="logo"><img
                            src="{{asset(@$system->logo)}}" ></a>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="top-search">
                                <form action="{{route('search')}}" method="get">
                                    <input type="text" name="key_search"
                                           placeholder="Tìm kiếm sản phẩm mà bạn muốn mua tại đây" value="">
                                    <button type="submit" class="click-search" style="border: 0px;">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12 hotline-phone-mobile">
                            <div class="holine-top" style="float: right">
                                <span class="title">Hotline</span>
                                <span class="phone-top">{{@$system->phone}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu">
                        <nav class="menu">
                            <ul>
                                <li class="devices  ">
                                    <a href="{{route('home')}}">Trang chủ</a>
                                </li>
                                @if(isset($header) && count($header) > 0)
                                    @foreach($header as $headers)
                                    <li>
                                        <a href="{{route('blog',$headers->slug)}}" title="{{$headers->name}}">{{$headers->name}}</a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
