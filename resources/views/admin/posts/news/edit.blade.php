@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cập nhật {{$titlePage}}</h5>
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
                            <form action="{{url("admin/post/update",$news->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-3 col-form-label">Tên bài viết</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" required class="form-control"
                                               value="{{$news->name}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3 d-flex align-items-center">
                                        <p class="m-0">Danh mục (<span style="color: red"> * </span>) :</p>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="category_post_id" class="form-select">
                                            @foreach($category as $val)
                                            <option value="{{$val->id}}" @if($news->category_post_id == $val->id) selected @endif>{{$val->name}}
                                            </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-header bg-info text-white">
                                        Nội dung
                                    </div>
                                    <div class="card-body mt-2">
                                        <textarea name="content" class="ckeditor">{!! $news->content !!}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">Bài viết mặc định :</div>
                                    <div class="col-8">
                                        <label class="switch form-check form-switch">
                                            <input type="checkbox" class="form-check-input" @if($news->is_default == 1) checked
                                                   @endif name="is_default">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3">Bật/tắt :</div>
                                    <div class="col-8">
                                        <label class="switch form-check form-switch">
                                            <input type="checkbox" class="form-check-input" @if($news->display == 1) checked
                                                   @endif name="display">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-3"></div>
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <a href="{{route('admin.post.index')}}" class="btn btn-danger">Hủy</a>
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
    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '500px'
        });
    </script>
@endsection
