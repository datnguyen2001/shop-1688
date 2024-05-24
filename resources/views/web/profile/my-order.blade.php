@extends('web.index')
@section('title','Quản lý đơn hàng')

@section('style_page')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/date.css')}}">
    <link href="{{asset('assets/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .pagenavi ul a{
            line-height: unset;
        }
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
        .processing {
            background: #f4c58f;
            color: #815621 !important;
        }

        .success {
            background: #75a630;
            color: #fff !important;
        }

        .canceled,
        .lack {
            background: #333;
            color: #fff !important;
        }
        .pagenavi{
            display: flex;
            justify-content: center;
        }
        @media (max-width: 767px) {
            td,th{
                min-width: 120px;
            }

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
                <div class="col-12">
                    <h1 class="xbbb" style="margin-top: 0px;font-size: 20px;font-weight: bold">Danh sách đơn hàng</h1>
                    <form method="get" action="{{route('my-order')}}">
                        <div >
                            <div class="input-group pull-left col-md-5 col-xs-12 col-sm-4" style="margin-right: 10px">
                                <input type="text" name="keyword" value="{{request()->get('keyword')}}" class="form-control" placeholder="Search" autocomplete="off">
                            </div>
                            <div class="input-group filter-box pull-left col-md-5 col-xs-12 col-sm-4" style="margin-right: 10px">
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
                        <div class="mt-5 space-y-2">
                            <div class="relative overflow-x-auto table-responsive">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 py-2">
                                            Mã đơn hàng
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Ảnh
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Sản phẩm
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Ngày lên đơn
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Trạng thái
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Ghi chú
                                        </th>
                                        <th scope="col" class="px-2 py-2 text-center">
                                            #
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($order) && count($order)>0)
                                        @foreach($order as $item)
                                    <tr class="bg-white dark:bg-gray-800 border-b">
                                        <th scope="row"
                                            class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            <span
                                                                class="font-bold text-primary underline">{{$item->code_order}}</span>
                                        </th>
                                        <td class="px-2 py-2">
                                            <img src="{{asset($item->product->src)}}"
                                                 style="width: 100px;">
                                        </td>
                                        <td class="px-2 py-2">
                                            Mã sản phẩm: <span
                                                style="color: red;font-weight: bold">{{$item->product->code}}</span><br>
                                            Tên sản phẩm: <span
                                                style="color: red;font-weight: bold">{{$item->product->name}}</span><br>
                                        </td>
                                        <td class="px-2 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td class="px-2 py-2">
                                                            <span
                                                                class="flex p-[1px] text-xs rounded-lg text-center justify-center items-center bg-green-600 text-white cursor-pointer js_payment_update js_payment_67742 @if($item->status == 0) opened @elseif($item->status == 2 || $item->status == 1) processing @elseif($item->status == 3) success @else cancle @endif"
                                                                ">{{$item->status_name}}</span>
                                        </td>
                                        <td class="px-2 py-2">
                                            {!! $item->note1 !!}<br>
                                            <div><b class="font-bold text-red-600" style="color: red;">Ghi chú của người bán: </b> {!! $item->note2 !!}</div><br>
                                        </td>
                                        <td class="px-2 py-2">
                                            @if($item->status == 0)
                                                <a href="{{url('cancel-order/'.$item->id)}}" class="btn btn-danger btn-cancel" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Hủy đơn hàng">Hủy đơn hàng</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center w-100">
                                    {{ $order->appends(request()->all())->links('web.partials.pagination') }}
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
