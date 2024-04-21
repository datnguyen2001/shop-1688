@extends('web.index')
@section('title','Quản lý đơn hàng')

@section('style_page')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/date.css')}}">
    <link href="{{asset('assets/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        form .input-group {
            margin-bottom: 5px;
        }
        .confirm {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px;
            border-radius: 5px;
        }

        .confirm.yes {
            background: green;
            color: #fff !important;
        }

        .confirm.no {
            background: red;
            color: #fff !important;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0px;
            border-bottom: 2px solid red;
        }

        .sweet-alert button {

            font-size: 17px !important;
        }
        .itemsgiohang > div {
            margin-bottom: 5px;
        }

        .itemsgiohang {
            margin-bottom: 5px;
            border-bottom: 2px solid red !important;
            border: 1px solid #dddddd;
            padding: 5px;
        }

        .opened {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px 10px;
            background: #ed1830;
            color: #fff;
            border-radius: 5px;
        }

        .processing {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px 10px;
            background: #f4c58f;
            color: #815621 !important;
            border-radius: 5px;
        }

        .success {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px 10px;
            background: #75a630;
            color: #fff;
            border-radius: 5px;
        }

        .cancle {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px 10px;
            background: #333;
            color: #fff;
            border-radius: 5px;
        }

        .confirm {
            display: inline-block;
            font-weight: bold;
            font-size: 10px !important;
            padding: 3px 10px;
            border-radius: 5px;
        }

        .confirm.no {
            background: red;
            color: #fff !important;
        }

        .confirm.yes {
            background: green;
            color: #fff !important;
        }

    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ /</a></li>
                <li><a >Đơn mua</a></li>
            </ul>
        </div>
    </div>
    <div class="main-child">
        <div class="container container1000">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <h1 class="xbbb" style="margin-top: 0px;font-size: 20px;font-weight: bold">Danh sách đơn hàng</h1>
                    <form method="get" action="{{route('my-order')}}">
                        <div class="">
                            <div class="input-group pull-left col-md-4 col-xs-12 col-sm-4" style="margin-right: 10px">
                                <input type="text" name="keyword" value="{{request()->get('keyword')}}" class="form-control" placeholder="Search" autocomplete="off">
                            </div>
                            <div class="input-group filter-box pull-left col-md-4 col-xs-12 col-sm-4" style="margin-right: 10px">
                                <select name="status" class="form-control status">
                                    <option value="" selected>[Chọn trạng thái]</option>
                                    <option value="0" @if(request()->get('status') === 0) selected @endif>Chờ xác nhận</option>
                                    <option value="1" @if(request()->get('status') === 1) selected @endif>Chờ lấy hàng</option>
                                    <option value="2" @if(request()->get('status') === 2) selected @endif>Đang vận chuyển</option>
                                    <option value="3" @if(request()->get('status') === 3) selected @endif>Đã hoàn thành</option>
                                    <option value="4" @if(request()->get('status') === 4) selected @endif>Đã hủy</option>
                                    <option value="5" @if(request()->get('status') === 5) selected @endif>Hàng bị thiếu</option>
                                </select>
                            </div>
                            <div class="input-group filter-box pull-left col-md-1 col-xs-12 col-sm-1" style="display: flex">
                                <button type="submit" value="action" class="btn btn-default"
                                        style="border-radius: 0px;width: fit-content"><i class="fa fa-search"></i></button>
                                <a href="{{route('my-order')}}" class="btn btn-danger" style="margin-left: 10px">Hủy</a>
                            </div>
                        </div>
                    </form>
                    <div style="clear: both;height: 10px"></div>
                    <div class=" main-order">
                        <div class="box-body  no-padding">
                                @if(isset($order) && count($order)>0)
                                    @foreach($order as $item)
                                <div class="itemsgiohang"  @if($item->status == 4) style="background: #dad9d9;" @endif  >
                                    <div class="row">
                                        <div style="width: 90%; display: flex;justify-content: space-between;align-items:center;margin-left: 15px">
                                            <div>
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}
                                            </div>
                                            @if($item->status == 0)
                                            <a href="{{url('cancel-order/'.$item->id)}}" class="btn btn-danger btn-cancel" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Hủy đơn hàng">Hủy đơn hàng</a>
                                                @endif
                                             </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <img src="{{asset($item->product->src)}}"
                                                 alt="{{$item->product->name}}"
                                                 style="width: 100px"><br>
                                        </div>
                                        <div class="col-sm-6 col-xs-6" style="padding-left: 0px">
                                            <b>Mã đơn hàng: </b> <span
                                                style="font-weight:bold;color:#006dad;">{{$item->code_order}}</span><br>
                                            <b>Mã sản phẩm: </b> <span
                                                style="color: red;font-weight: bold">{{$item->product->code}}</span><br>
                                            <b>Tên sản phẩm: </b> <span
                                                style="color: red;font-weight: bold">{{$item->product->name}}</span><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12" style="padding: 0">
                                        <div class="show-note col-sm-6 col-xs-12" style="padding: 0">
                                            <b>Ghi chú: </b>
                                            <div class="list-note" style="margin: 6px 0;">
                                                {!! $item->note1 !!}
                                            </div>
                                        </div>
                                        <div class="show-note col-sm-6 col-xs-12" style="padding: 0">
                                            <b>Ghi chú của người bán: </b>
                                            <div class="list-note" style="margin: 6px 0;">
                                                {!! $item->note2 !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <b> Trạng thái: </b>
                                        <span class="@if($item->status == 0) opened @elseif($item->status == 2 || $item->status == 1) processing @elseif($item->status == 3) success @else cancle @endif">{{$item->status_name}}</span>
                                    </div>
                                </div>
                                    @endforeach
                                        <div>
                                            {{ $order->appends(request()->all())->links('web.partials.pagination') }}
                                        </div>
                                    @else
                                    <p style="color: #FF0000;font-size: 16px;margin-top: 30px;text-align: center">Không có dữ liệu</p>
                                    @endif

                        </div><!-- /.box-body -->


                        <div class="box-footer clearfix">
                        </div>

                    </div>
                </div>
                <div style="clear: both" class="visible-xs"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
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
                                gia: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }} </p>
                            <ul>
                                <li><a href="{{route('profile')}}" title="">Tài khoản của tôi<i class="fas fa-chevron-right"></i></a></li>
                                <li><a href="{{route('password')}}" title="">Đổi mật khẩu<i class="fas fa-chevron-right"></i></a></li>
                                <li class="active"><a href="{{route('my-order')}}" title="">Đơn mua<i class="fas fa-chevron-right"></i></a></li>
                                <li><a href="{{route('logout')}}" title="">Thoát<i class="fas fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>


@stop
@section('script_page')
    <script src="{{asset('assets/js/date.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $('a.btn-cancel').confirm({
            title: 'Hủy đơn hàng!',
            content: 'Bạn có chắc chắn muốn hủy đơn hàng này?',
            buttons: {
                ok: {
                    text: 'Xác nhận',
                    btnClass: 'btn-danger',
                    action: function(){
                        location.href = this.$target.attr('href');
                    }
                },
                close: {
                    text: 'Hủy',
                    action: function () {}
                }
            }
        });
    </script>
@stop
