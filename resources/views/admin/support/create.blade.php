@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tạo mới hỗ trợ trực tuyến</h5>
                            <!-- General Form Elements -->
                            @if (session('error'))
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{session('error')}}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('admin.support-staff.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Họ và tên</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="facebook" required class="form-control" placeholder="link facebook">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-5">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                        <a href="{{route('admin.support-staff.index')}}" class="btn btn-danger">Hủy</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')

@endsection
