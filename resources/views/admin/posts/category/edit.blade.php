@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cập nhật danh mục bài viết</h5>
                            <!-- General Form Elements -->
                            @if (session('error'))
                                <div
                                    class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{session('error')}}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{url('admin/category-post/update-category/'.$category->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên danh mục</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{$category->name}}" required
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-5">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Cập nhập</button>
                                        <a href="{{route('admin.category-post.index-cate')}}" class="btn btn-danger">Hủy</a>
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
