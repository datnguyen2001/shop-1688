@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chi tiết liên hệ</h5>
                            <!-- General Form Elements -->
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" required class="form-control"
                                           value="{{$contact->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" required class="form-control"
                                           value="{{$contact->phone}}">
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-header bg-info text-white">
                                    Nội dung
                                </div>
                                <div class="card-body mt-2">
                                    <textarea name="content" class="ckeditor">{!! $contact->content !!}</textarea>
                                </div>
                            </div>

                            <a href="{{route('admin.contact')}}" class="btn btn-success">Quay lại</a>
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
