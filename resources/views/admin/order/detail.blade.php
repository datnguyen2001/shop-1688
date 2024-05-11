@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Mã đơn hàng: {{$listData->code_order}}</h5>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div
                                    class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{session('error')}}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <h8 class="card-title" style="color: #f26522">1. Thông tin tài khoản mua hàng</h8>
                            <br>
                            <br>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Tài hoản</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" disabled class="form-control"
                                           value="{{$listData['user']->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-3 col-form-label">Họ và tên zalo</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" id="phone" disabled class="form-control"
                                           value="{{$listData['user']->name_zalo}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại zalo</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" id="email" disabled class="form-control"
                                           value="{{$listData['user']->phone_zalo}}">
                                </div>
                            </div>
                            <h8 class="card-title" style="color: #f26522">2. Thông tin người nhận hàng</h8>
                            <br>
                            <br>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" disabled class="form-control"
                                           value="{{$listData->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" id="phone" disabled class="form-control"
                                           value="{{$listData->phone}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" id="email" disabled class="form-control"
                                           value="{{$listData->address}}">
                                </div>
                            </div>


                            <h8 class="card-title" style="color: #f26522">3. Thông tin chi tiết đơn hàng</h8>
                            <div class="card-body">

                                <table class="table table-borderless ">
                                    <thead>
                                    <tr>
                                        <th scope="col">Stt</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Màu sản phẩm</th>
                                        <th scope="col">Ghi chú</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table_data">
                                        <tr>
                                            <td>1</td>
                                            <td><img class="image-preview" style="width: 80px; height: auto"
                                                     src="{{asset($listData['product']->src)}}"></td>
                                            <td>{{$listData['product']->code}}</td>
                                            <td>{{$listData['product']->name}}</td>
                                            <td>{{$listData['product_color']->name}}</td>
                                            <td>{!! $listData->note1 !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h8 class="card-title" style="color: #f26522">4. Ghi chú của admin</h8>
                            <br>
                            <br>
                            <form class="row mb-3" method="post"
                                  action="{{url('admin/order/save-note/'.$listData->id)}}">
                                @csrf
                                <div class="col-sm-9">
                                    <textarea name="note2" id="" class="w-100 p-3" rows="5">{!! $listData->note2 !!}</textarea>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success ">Ghi chú</button>
                                </div>
                            </form>
                            @if($listData->status != 3)
                            <h8 class="card-title" style="color: #f26522">5. Cập nhật trạng thái đơn hàng</h8>
                            <br>
                            <br>
                            @endif
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    @if($listData->status == 0)
                                        <a href="{{url('admin/order/status/'.$listData->id.'/1')}}">
                                            <button type="submit" class="btn btn-primary">Xác nhận đơn hàng</button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/4')}}">
                                            <button type="submit" class="btn btn-danger">Huỷ đơn hàng</button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/5')}}">
                                            <button type="submit" class="btn btn-warning">Huỷ bị thiếu</button>
                                        </a>
                                    @elseif($listData->status == 1)
                                        <a href="{{url('admin/order/status/'.$listData->id.'/2')}}">
                                            <button type="submit" class="btn btn-primary">Giao hàng</button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/4')}}">
                                            <button type="submit" class="btn btn-danger">Huỷ đơn hàng</button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/5')}}">
                                            <button type="submit" class="btn btn-warning">Huỷ bị thiếu</button>
                                        </a>
                                    @elseif($listData->status == 2)
                                        <a href="{{url('admin/order/status/'.$listData->id.'/3')}}">
                                            <button type="submit" class="btn btn-primary">Hoàn thành đơn hàng</button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/4')}}">
                                            <button type="submit" class="btn btn-danger">Hủy đơn hàng
                                            </button>
                                        </a>
                                        <a href="{{url('admin/order/status/'.$listData->id.'/5')}}">
                                            <button type="submit" class="btn btn-warning">Huỷ bị thiếu</button>
                                        </a>
                                    @endif
                                        @if($listData->status == 4)
                                            <a href="{{url('admin/order/status/'.$listData->id.'/1')}}">
                                                <button type="submit" class="btn btn-primary">Xác nhận lại đơn hàng</button>
                                            </a>
                                        @endif
                                        @if($listData->status == 5)
                                            <a href="{{url('admin/order/status/'.$listData->id.'/2')}}">
                                                <button type="submit" class="btn btn-primary">Giao hàng</button>
                                            </a>
                                            <a href="{{url('admin/order/status/'.$listData->id.'/3')}}">
                                                <button type="submit" class="btn btn-success">Hoàn thành đơn hàng</button>
                                            </a>
                                        @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
@section('script')
    <script src="assets/admin/order.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn-print").click(function () {
            $.ajax({
                url: window.location.origin + '/admin/order/label-print-order',
                data: {'order_id': $(this).val()},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.status) {
                        var newWin = window.open("", "_blank");
                        newWin.document.write(data.html);
                        newWin.onload = function () {
                            setTimeout(function () {
                                newWin.print();
                            }, 2000);
                        };
                        newWin.onafterprint = function () {
                            newWin.close();
                        };
                        newWin.print();
                    }
                }
            });
        })
    </script>
@endsection

