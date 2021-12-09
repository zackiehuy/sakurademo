<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="sakura company">
    <meta name="description" content="sakura company">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('') }}">
    <meta name="language" content="{{ App::getLocale() }}">
    <meta name="file_size" content="{{ __('base.file_size') }}">
    <link rel="shortcut icon" href="{{ $setting->logo ?? '' ? asset('storage/images/setting/logo/') . $setting->logo : asset("img/sakura_icon.png")}}" />
    <title>{{$setting->name ?? '' ? $setting->name : config('app.name') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('guest/inquiry/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('guest/fonts/SF-Pro-Display-Regular.otf')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/ress.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('guest/inquiry/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
    @yield('css')
</head>

<body>
<div class="wrapper home-page main-content @yield('company-top')">
    @include('front-end.guest.header')
    <div class="content-sakura-main">
        @yield('content')
    </div>
    @include('front-end.guest.footer')
    @include('front-end.guest.menu')
</div>

<script type="text/javascript">
    @if (Session::has('alert_message'))
    let level = "{{ Session::get('alert_level') }}";
    let message = "{{ Session::get('alert_message') }}";
    let title = "{{ Session::get('alert_title') }}";
    switch (level) {
        case 'warning':
            // alert(title + ' ' + message)
            break;
        default:
            break;
    }
    @endif

</script>
<script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{asset('guest/js/jquery.min.js')}}"></script>
<script src="{{asset('guest/js/bootstrap.js')}}"></script>
<script src="{{asset('guest/js/bootstrap.min.js')}}"></script>
<script src="{{asset('guest/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('guest/js/wow.min.js')}}"></script>
<script src="{{asset('guest/js/function.js')}}"></script>
@yield('javascript')

</body>

</html>
