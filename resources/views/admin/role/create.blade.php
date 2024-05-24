@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm mới nhân viên</h5>
                            <!-- General Form Elements -->
                            @if (session('error'))
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                    {{session('error')}}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('admin.role.store')}}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tên nhân viên</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Mật khẩu</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" required class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <h8 class="card-title" style="color: #f26522">Lựa chọn quyền</h8>
                                <br>
                                <br>
                                @foreach(config('menu_aside.admin') as $menu)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="arr[{{$menu['number']}}]" type="checkbox" id="{{$menu['number']}}">
                                        <label class="form-check-label" for="{{$menu['number']}}">{{$menu['title']}}</label>
                                    </div>
                                @endforeach
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')

@endsection
