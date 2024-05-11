@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body d-flex align-items-center flex-wrap"
                             style="padding-top: 20px">
                            <a href="{{url('admin/order/index/all')}}" type="button"
                               class="btn btn-outline-secondary mb @if($status == 'all') active @endif"> Tất cả đơn hàng
                                <span style="font-weight: 700">{{$order_all}}</span></a>
                            <a href="{{url('admin/order/index/0')}}"
                               class="btn btn-outline-warning mx-3 @if($status == 0) active @endif">Chờ xác nhận <span
                                    style="font-weight: 700">{{$order_pending}}</span></a>
                            <a href="{{url('admin/order/index/1')}}" type="button"
                               class="btn btn-outline-info @if($status == 1) active @endif">Chờ lấy hàng <span
                                    style="font-weight: 700">{{$order_confirm}}</span></a>
                            <a href="{{url('admin/order/index/2')}}" type="button"
                               class="btn btn-outline-primary mx-3 @if($status == 2) active @endif">Đang vận chuyển <span
                                    style="font-weight: 700">{{$order_delivery}}</span></a>
                            <a href="{{url('admin/order/index/3')}}" type="button"
                               class="btn btn-outline-success @if($status == 3) active @endif">Đơn hàng hoàn thành <span
                                    style="font-weight: 700">{{$order_complete}}</span></a>
                            <a href="{{url('admin/order/index/4')}}" type="button"
                               class="btn btn-outline-danger mx-3 @if($status == 4) active @endif">Đơn huỷ <span
                                    style="font-weight: 700">{{$order_cancel}}</span></a>
                            <a href="{{url('admin/order/index/5')}}" type="button"
                               class="btn btn-outline-danger mt-3 @if($status == 5) active @endif">Hàng bị thiếu <span
                                    style="font-weight: 700">{{$return_refund}}</span></a>
                        </div>
                    </div>

                    <div class="card" >
                        <div class="card-body d-flex justify-content-end" style="padding: 20px">
                            <form class="d-flex align-items-center w-50" method="get"
                                  action="{{url('admin/order/index/'.$status)}}">
                                <input name="search" type="text" value="{{request()->get('search')}}"
                                       placeholder="Tìm kiếm theo mã đơn hàng, người mua, số điện thoại" class="form-control" style="margin-right: 16px">
                                <button class="btn btn-info" style="margin-left: 15px"><i class="bi bi-search"></i>
                                </button>
                                <a href="{{url('admin/order/index/'.$status)}}" class="btn btn-danger"
                                   style="margin-left: 15px">Hủy </a>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{$titlePage}}</h5>
                            </div>
                            @if(count($listData) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Tài khoản</th>
                                        <th scope="col">Ghi chú</th>
                                        @if($status == 0 || $status == 'all' || $status == 1 || $status == 2 || $status == 3 || $status == 4)
                                            <th scope="col" style="width: 15%;">Xác nhận nhanh</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listData as $k => $value)
                                        <tr>
                                            <th id="{{$value->id}}" scope="row">{{$k+1}}</th>
                                            <td>
                                                <a href="{{url('admin/order/detail/'.$value->id)}}"
                                                   class="btn btn-icon btn-light btn-hover-success btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                   data-bs-original-title="Chi tiết đơn hàng">
                                                    {{$value->code_order}}<br>
                                                    <span
                                                        style="color: @if($value->status == 0) #FF9900 @elseif($value->status == 1) #0099FF @elseif($value->status == 2) #0066FF @elseif($value->status == 3) #00FF00 @elseif($value->status == 4) #FF3333 @endif; font-weight: 600">{{$value->status_name}}</span>
                                                    <br>{{$value->created_at}}
                                                </a>
                                            </td>
                                            <td style="font-size: 14px">
                                                <img src="{{asset($value->product->src)}}" style="width: 80px;"><br>
                                                Mã sp: <span style="color: #FF0000">{{$value->product->code}}</span><br>
                                                Tên sp: <span style="color: #FF0000">{{$value->product->name}}</span>
                                            </td>
                                            <td style="font-size: 14px">
                                                Tên tk: {{$value->user->name}}<br>
                                                Tên zalo: {{$value->user->name_zalo}}<br>
                                                SDT zalo: {{$value->user->phone_zalo}}
                                            </td>
                                            <td style="font-size: 14px">
                                                {!! $value->note1 !!}<br>
                                                @if($value->note2 != null)
                                                <span style="color: #FF0000">Admin note</span><br>
                                                {!! $value->note2 !!}
                                                    @endif
                                            </td>
                                            <td style="border-top: 1px solid #cccccc">
                                                @if($value->status == 0)
                                                    <a href="{{url('admin/order/status/'.$value->id.'/1')}}">
                                                        <button type="submit" class="btn btn-primary mb-2">Xác nhận đơn
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/4')}}">
                                                        <button type="submit" class="btn btn-danger mb-2">Huỷ đơn hàng
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/5')}}">
                                                        <button type="submit" class="btn btn-warning">Hàng bị thiếu
                                                        </button>
                                                    </a>
                                                @elseif($value->status == 1)
                                                    <a href="{{url('admin/order/status/'.$value->id.'/2')}}">
                                                        <button type="submit" class="btn btn-primary mb-2">Giao hàng
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/4')}}">
                                                        <button type="submit" class="btn btn-danger mb-2">Huỷ đơn hàng
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/5')}}">
                                                        <button type="submit" class="btn btn-warning">Hàng bị thiếu
                                                        </button>
                                                    </a>
                                                @elseif($value->status == 2)
                                                    <a href="{{url('admin/order/status/'.$value->id.'/3')}}">
                                                        <button type="submit" class="btn btn-primary mb-2">Hoàn thành đơn
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/4')}}">
                                                        <button type="submit" class="btn btn-danger mb-2">Hủy đơn hàng
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/5')}}">
                                                        <button type="submit" class="btn btn-warning">Hàng bị thiếu
                                                        </button>
                                                    </a>
                                                @endif
                                                @if($value->status == 4)
                                                        <a href="{{url('admin/order/status/'.$value->id.'/1')}}">
                                                            <button type="submit" class="btn btn-primary mb-2">Xác nhận lại đơn
                                                            </button>
                                                        </a>
                                                    @endif
                                                @if($value->status != 4 && $value->status != 0 && $value->status != 5 && $value->status != 3 && $value->type_payment == 2)
                                                        <a href="{{url('admin/order/status/'.$value->id.'/2')}}">
                                                            <button type="submit" class="btn btn-primary mb-2">Giao hàng
                                                            </button>
                                                        </a>
                                                        <a href="{{url('admin/order/status/'.$value->id.'/3')}}">
                                                            <button type="submit" class="btn btn-primary">Hoàn thành đơn
                                                            </button>
                                                        </a>
                                                    @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $listData->appends(request()->all())->links('admin.pagination_custom.index') }}
                                </div>
                            @else
                                <h5 class="card-title">Không có dữ liệu</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $('a.btn-delete').confirm({
            title: 'Xác nhận!',
            content: 'Bạn có chắc chắn muốn xóa bản ghi này?',
            buttons: {
                ok: {
                    text: 'Xóa',
                    btnClass: 'btn-danger',
                    action: function () {
                        location.href = this.$target.attr('href');
                    }
                },
                close: {
                    text: 'Hủy',
                    action: function () {
                    }
                }
            }
        });
    </script>
@endsection
