@extends('web.index')
@section('title','Trang chủ')

@section('style_page')

@stop
{{--content of page--}}
@section('content')
    <section class="top-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInUp">
                    <div class="item-category">
                        <h2 class="title-category" style="text-transform: uppercase">Danh mục sản phẩm</h2>
                        <div class="nav-item-category">
                            <div class="row">
                                @if(isset($category))
                                    @foreach($category as $cate)
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item item1">
                                                <div class="image">
                                                    <a href="{{route('category',$cate->slug)}}"
                                                       title="{{$cate->name}}"><img
                                                            src="{{@$cate->src}}"
                                                            alt="{{$cate->name}}"></a>
                                                </div>
                                                <h3 class="title"><a href="{{route('category',$cate->slug)}}"
                                                                     title="{{$cate->name}}">{{$cate->name}}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($product_category) && count($product_category)>0)
        @foreach($product_category as $pro)
            <section class="why-choose">
                <div class="container">
                    <div class="main-content-product">
                        <a href="{{route('category',$cate->slug)}}" class="title-pr">{{$pro->name}}</a>
                        <div class="content-product">
                            <div class="row">
                                @foreach($pro->product as $item)
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="item-product wow fadeInUp">
                                            <div class="image">
                                                <a href="{{route('detail-product',$item->slug)}}"
                                                   title="{{$item->name}}"><img
                                                        src="{{asset($item->src)}}"
                                                        alt="{{$item->name}}"></a>
                                            </div>
                                            <div class="nav-img">
                                                <h3 class="title"><a href="{{route('detail-product',$item->slug)}}"
                                                                     title="{{$item->name}}">{{$item->name}}</a>
                                                </h3>
                                                <p class="masp">Mã sản
                                                    phẩm: {{$item->code}}</p>
                                                <p class="price">Giá <span>{{number_format($item->price)}} đ</span></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endforeach
    @endif

    <section class="why-choose">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-12 wow fadeInUp">
                    <div class="image">
                        <img src="{{asset('assets/images/trang-chu.jpg')}}"
                             alt="images">
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 wow fadeInUp">
                    <div class="nav-image">
                        <h3 class="title">VÌ SAO BẠN CHỌN {{@$system->brand_name}} KHỞI NGHIỆP CÙNG BẠN</h3>
                        <ul>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt=""> Vì sao bạn chọn {{@$system->brand_name}} khởi nghiệp cùng bạn
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Hàng hóa phong phú , đa dạng, bắt nhịp theo trend
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Giá cả vô cùng cạnh tranh
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Phục vụ chuyên nghiệp, nhanh chóng
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Quản lí đơn hàng đơn giản, hiệu quả và tự động
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Đổi trả hàng nếu không hài lòng về sản phẩm
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                hận tìm hàng theo yêu cầu
                            </li>
                            <li><img src="{{asset('assets/images/icon3.jpg')}}"
                                     alt="">
                                Nhận mua hàng theo link sẵn có
                            </li>

                        </ul>
                        <a href="{{route('contact')}}" title="liên hệ"
                           class="lienhe-shop"><span>+</span>Liên hệ Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(isset($support) && count($support)>0)
        <section class="customer-consulting">
            <div class="container">
                <div class="customer-home">
                    <div class="row">
                        @foreach($support as $supports)
                            <div class="col-md-3 col-sm-6 col-xs-6 wow fadeInUp">
                                <div class="item">
                                    <h3 class="title">Nhân viên {{$supports->name}}</h3>

                                    <p class="holine">Hotline:<span> {{$supports->phone}}</span></p>
                                    <ul>
                                        <li><a href="{{$supports->facebook}}" target="_blank"><img
                                                    src="{{asset('assets/images/icon4.png')}}" alt=""></a></li>
                                        <li><a href="https://zalo.me/{{$supports->phone}}" target="_blank"><img
                                                    src="{{asset('assets/images/icon5.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@stop
@section('script_page')

@stop
