@extends('web.index')
@section('title','Hòm thư góp ý')

@section('style_page')
    <style>
        .sidebar .accordion-container .set .click-parent1 {
            font-family: 'GOOGLESANS-BOLD_0';
            background: #449727;
            color: #fff;
            border-bottom: 1px solid #fff;
            position: relative;
        }

        /*css contact*/
        p.thank-you {
            font-size: 14px;
            color: #747474;
            font-style: italic;
        }

        h1.title-contact {
            color: #3498db;
            font-size: 22px;
            text-transform_gopy: uppercase;
            margin-top: 0;
        }

        .adress-contact li {
            font-size: 14px;
            list-style: none;
            padding-bottom: 7px;
        }

        .adress-contact li span {
            font-family: 'Roboto-Bold';
        }

        .adress-contact {
            padding-left: 0;
        }

        .map-contact iframe {
            width: 100%;
            height: 369px;
        }

        .map-contact {
            border: 1px solid #ddd;
            padding: 2px;
        }

        .form-contat p.desc {
            font-size: 14px;
            line-height: 23px;
        }

        .form-contat input[type=text] {
            border: 1px solid #d5d5d5;
            background: #fafafa;
            width: 100%;
            height: 30px;
            padding-left: 10px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .form-contat textarea {
            width: 100%;
            height: 265px;
            background: #fafafa;

            padding-left: 10px;
            border-radius: 3px;
        }

        .send-contact .item {
            width: calc((100% - 30px) / 4);
            display: inline-block;
            float: left;
            margin-right: 10px;
            text-align: center;
        }

        .send-contact .item:nth-child(4) {
            margin-right: 0;
        }

        .send-contact .item input[type=submit] {
            width: 100%;
            height: 30px;
            background: #3498db;
            font-size: 14px;
            text-transform_gopy: uppercase;
            color: #fff;
            border: 1px solid;
            border-radius: 3px;
        }

        .send-contact .item img {
            padding-top: 4px;
        }

        #main-contact {
            /* margin-top: 13px; */
            margin-bottom: 30px;
        }

        #main-contact {
            margin-top: 30px;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ /</a></li>
                <li><a>Hòm thư góp ý</a></li>
            </ul>
        </div>
    </div>
    <div class="main-child main-child1">
        <div class="container">
            <div class="row">
                @include('web.partials.menu')
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="main-content-product">
                        <div class="content-primary main-detail">
                            <h1 class="title">Hòm thư góp ý</h1>
                            <div class="description">
                                <p style="text-align: justify;"><span style="font-size:14px;"><span
                                            style="font-family:Arial,Helvetica,sans-serif;"><strong>Mọi thông tin chi tiết xin liên hệ:</strong><br/>
                                <span style="color:#339933;"><strong> {{@$system->brand_name}}</strong></span><br/>
                                <strong>Địa chỉ: </strong><em> {{@$system->address}} </em><br/>
                                <strong>Hotline:</strong><em> </em></span></span><span style="font-size:14.0pt"><span
                                                                            style="line-height:107%"><span> {{@$system->phone}}</span></span></span><br/>
                                                                    <span style="font-size:14px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>Email:</strong><em> {{@$system->email}}</em><br/>
                                <strong>Website: </strong><em>{{@$system->website}}</em></span></span></p>

                            </div>
                            <div class="form-lien" style="margin-top: 20px">
                                <div class="form-contat">
                                    <p class="desc" style="font-weight: bold;font-size: 20px">Mọi thông tin chi tiết xin
                                        liên hệ!</p>
                                    <form action="{{route('save-contact')}}" method="post" id="sform_gopy">
                                        @csrf
                                        <input type="text" placeholder="Họ và tên *" name="fullname" id="fullname_gopy" required>
                                        <input type="text" placeholder="Số điện thoại" name="phone" id="phone_gopy" required>
                                        <textarea name="content" cols="40" rows="10" placeholder="Nội dung *"
                                                  id="message_gopy" required></textarea>
                                        <div class="send-contact">
                                            <div class="item">
                                                <input type="submit" name="create" value="Gửi đi">
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
    </div>
    </div>


@stop
@section('script_page')

@stop
