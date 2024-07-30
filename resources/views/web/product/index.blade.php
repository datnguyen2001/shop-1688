@extends('web.index')
@section('title','Chi tiết sản phẩm')
@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <style>
        #show_flashdata_frontend {
            display: none;
        }

        #result-color {
            text-transform: capitalize;
            font-weight: 700;
            color: #ee4d2d;
            font-size: 14px;
        }

        a:focus {
            outline: unset;
        }

        .mt-list .slick-track {
            width: 100% !important;
        }

        .title1, .other-product .title1 {
            font-family: "GOOGLESANS-BOLD_0";
            font-size: 18px;
            text-transform: uppercase;
            color: #4aa02c;
            padding-bottom: 10px;
        }

        .muahang {
            color: #fff;
            background: #ee4d2d;
            display: inline-block;
            float: left;
            font-size: 16px;
            text-transform: uppercase;
            height: 40px;
            line-height: 40px;
            padding: 0 29px;
            border: 0px;
            outline: none;
        }

        .muahang:hover {
            color: white;
        }

        .btn-dowload {
            background: #39881d;
            color: white;
            border: none;
            outline: unset;
            border-radius: 4px;
            padding: 5px 15px;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ /</a></li>
                <li><a>{{$product->name}}</a></li>
            </ul>
        </div>
    </div>

    <div class="main-child main-child1">
        <div class="container">
            <div class="row">
                @include('web.partials.menu')
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="main-detail-product">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="list-img ">
                                    <div class="slider-all" style="margin-bottom: 15px">
                                        @if(isset($product_color))
                                            @foreach($product_color as $index => $img_color)
                                                <div class="item" id="gc_container_owl">
                                                    <img src="{{asset($img_color->src)}}"
                                                         style="height: 409px;width: 100%;">
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(isset($product_image))
                                            @foreach($product_image as $index => $img)
                                                <div class="item" id="gc_container_owl">
                                                    <img src="{{asset($img->src)}}" style="height: 409px;width: 100%;">
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="slider-one">
                                        @if(isset($product_color))
                                            @foreach($product_color as $index => $img_color)
                                                <a data-index="{{ $index }}">
                                                    <img src="{{asset($img_color->src)}}"
                                                         style="height: 95px;width: 100%;padding-right: 5px">
                                                </a>
                                            @endforeach
                                        @endif
                                        @if(isset($product_image))
                                            @foreach($product_image as $index => $img)
                                                <a data-index="{{ $index }}">
                                                    <img src="{{asset($img->src)}}"
                                                         style="height: 95px;width: 100%;padding-right: 5px">
                                                </a>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="borderImgRadius color_each swatch detail-product-right">
                                    <h3 class="title">{{$product->name}}</h3>
                                    <div id="show_flashdata_frontend_products">
                                    </div>
                                    <div style="display: flex;justify-content: space-between;align-items: center">
                                        <ul>
                                            <li>Mã sản
                                                phẩm: {{$product->code}}
                                            </li>
                                        </ul>
                                        <button onclick="downloadAllImages()" class="btn-dowload">
                                            Download ảnh
                                        </button>
                                    </div>
                                    <div style="width: 100%;float: left;font-size: 18px">
                                    </div>
                                    <form action="{{route('save-order')}}" method="post" name="myForm" id="commentForm">
                                        @csrf
                                        <div class="selec-size">
                                            <p>Chọn màu</p>
                                            <div class="select-swap">
                                                <div class="list_attr_advanced">
                                                    <div class="item_attr_advanced mt-flex mt-flex-middle mb5">
                                                        <div class="content_attr">
                                                            <ul class="mt-list mt-clearfix">
                                                                @foreach($product_color as $key => $color)
                                                                    <li class="color-img" data-value="{{$color->id}}"
                                                                        data-color="{{$color->name}}"
                                                                        data-index="{{$key}}"
                                                                        data-src="{{$color->src}}">
                                                                        <a class="chose_attr_advanced {{$key == 0?'active':''}}"
                                                                           style="padding: 0px"><img
                                                                                src="{{asset($color->src)}}"
                                                                                alt="{{$color->name}}"
                                                                                style="width: 35px;height: 35px;object-fit: cover"></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" id="imageUrl" value="{{$product_color[0]->src}}" hidden>
                                            <input type="text" hidden value="{{$product->id}}" name="product_id">
                                            <input type="text" hidden value="{{$product_color[0]->id}}" name="color_id">
                                            <div id="result-color">{{$product_color[0]->name}}</div>
                                        </div>

                                        @if(isset($user))
                                            <div class="quantity-box">
                                                <div class="dathangngay add-tocart" style="width: 100%">
                                                <textarea rows="5" class="form-control " id="messagecart" name="note1"
                                                          style="margin-bottom: 10px"
                                                          placeholder="Ghi chú
Nhập Enter để xuống dòng"></textarea>
                                                    <button type="submit" class="muahang ajax-addtocart" name="muangay"
                                                            value="muangay" style="border-radius: 0px">Đặt hàng
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-12 col-xs-12 col-sm-12"
                                                 style="padding: 0px;margin-top: 15px;">
                                                <div class="dathangngay add-tocart">
                                                    <a href="{{route('login')}}" type="button" class="muahang"
                                                       style="border-radius: 0px">
                                                        Đăng nhập để mua hàng
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <h3 class="title1" style="margin-bottom: 0">Thông tin sản phẩm <img src="{{asset('assets/images/clipboard.svg')}}" style="width: 18px;margin-left: 15px;cursor: pointer" onclick="copyContent()"></h3>
                        <div class="information-product" style="padding-top: 0">
                            {!! $product->content !!}
                        </div>
                        <div class="other-product">
                            <h3 class="title1">Các sản phẩm khác</h3>

                            <div class="row">
                                @if(isset($product_more))
                                    @foreach($product_more as $more)
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item-product   ">
                                                <div class="image">
                                                    <a href="{{route('detail-product',$more->slug)}}"
                                                       title="{{$more->name}}"><img
                                                            src="{{asset($more->src)}}"
                                                            alt="{{$more->name}}"></a>
                                                </div>
                                                <div class="nav-img">
                                                    <h3 class="title"><a href="{{route('detail-product',$more->slug)}}"
                                                                         title=" {{$more->name}}"> {{$more->name}}</a>
                                                    </h3>
                                                    <p class="masp">Mã sản
                                                        phẩm: {{$more->code}}</p>

                                                    <p class="price">Giá <span>{{number_format($more->price)}}đ</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if(isset($product_viewed) && count($product_viewed)>0)
                            <div class="other-product">
                                <h3 class="title1">Sản phẩm đã xem</h3>
                                <div class="row">
                                    @foreach($product_viewed as $viewed)
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item-product">
                                                <div class="image">
                                                    <a href="{{route('detail-product',$viewed->slug)}}"
                                                       title="{{$viewed->name}}">
                                                        <img src="{{asset($viewed->src)}}" alt="{{$viewed->name}}"></a>
                                                </div>
                                                <div class="nav-img">
                                                    <h3 class="title"><a
                                                            href="{{route('detail-product',$viewed->slug)}}"
                                                            title="{{$viewed->name}}">{{$viewed->name}}</a>
                                                    </h3>
                                                    <p class="masp">Mã sản
                                                        phẩm: {{$viewed->code}}</p>
                                                    <p class="price">Giá <span>{{number_format($viewed->price)}}đ</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
@section('script_page')
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script>
        $('.slider-all').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-one'
        });
        $('.slider-one').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-all',
            dots: false,
            focusOnSelect: true,
            prevArrow: '<div class="d-none"></div>',
            nextArrow: '<div class="d-none"></div>',
        });

        $('.color-img').on('click', function () {
            var index = $(this).attr('data-index');
            $('.slider-all').slick('slickGoTo', index);
            $('.list_attr_advanced .chose_attr_advanced').removeClass('active');
            $(this).find('.chose_attr_advanced').addClass('active');
            var colorId = $(this).data('value');
            $('input[name="color_id"]').val(colorId);
            $('#result-color').html($(this).data('color'));
            var src = $(this).data('src');
            $('#imageUrl').val(src);
        });


        function downloadAllImages() {
            var productImages = @json($product_image).map(image => image.src);
            var colorImages = @json($product_color).map(color => color.src);
            var allImages = productImages.concat(colorImages);
            allImages.forEach((image, index) => {
                setTimeout(() => {
                    var hiddenAnchor = document.createElement('a');
                    hiddenAnchor.href = window.location.origin + '/' + image;
                    hiddenAnchor.download = 'image_' + (index + 1) + '.jpg';
                    document.body.appendChild(hiddenAnchor);
                    hiddenAnchor.click();
                    document.body.removeChild(hiddenAnchor);
                }, index * 1000);
            });
        }
    </script>
    <script>
        function copyContent() {
            var textarea = document.createElement("textarea");
            var content = document.querySelector('.information-product').innerText;
            textarea.value = content;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        }
    </script>
@stop
