<!doctype html>
<html lang="vi">

<head>
    <meta name="google-site-verification" content="googleeacc2166ce777ac3.html"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')</title>
    <link href="{{asset(@$system->logo)}}" rel="icon">
    <link href="{{asset(@$system->logo)}}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    @yield('style_page')
    <style>
        .swal2-popup.swal2-toast .swal2-title{
            font-size: 16px!important;
        }
        .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{
            width: 28px!important;
            height: 28px!important;
        }
        div:where(.swal2-icon).swal2-success .swal2-success-ring{
            top: -5px!important;
            left: -6px!important;
        }
    </style>
</head>

<body>
<div class="page-body-buong">
    @include('web.partials.header')
    <main id="main" class="wrapper">
        @yield('content')
    </main>
    @include('web.partials.footer')
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@yield('script_page')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    @if(session('error'))
    Toast.fire({
        icon: "error",
        title: "{{session('error')}}"
    });
    @endif

    @if(session('success'))
    Toast.fire({
        icon: "success",
        title: "{{session('success')}}"
    });
    @endif
</script>

</body>

</html>
