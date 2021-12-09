<!DOCTYPE html>
<!--
* CoreUI Free Laravel Bootstrap Admin Template
* @version v2.0.1
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="url" content="{{ url('') }}">
      <meta name="language" content="{{ App::getLocale() }}">
      <meta name="file_size" content="{{ __('base.file_size') }}">
   <link rel="shortcut icon" href="{{ $setting->logo ?? '' ? asset('storage/images/setting/logo/') . $setting->logo : asset("img/sakura_icon.png")}}" />
    <title>{{$setting->name ?? '' ? $setting->name : config('app.name') }} Admin | @yield('title')</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
{{--    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
{{--    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">--}}
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('lib/datatables/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('lib/iziToast/iziToast.min.css') }}">
      <link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{asset('lib/font-awesome/css/fontawesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('lib/datatables/css/bootstrap4-toggle.min.css') }}">
      <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('lib/datatables/js/jquery.dataTables.min.js')}}"></script>
  @yield('css')
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
{{--    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>--}}

    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

{{--    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">--}}
  </head>



  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show nav-menu" id="sidebar">

      @include('dashboard.shared.nav-builder')

      @include('dashboard.shared.header')

      <div class="c-body">

        <main class="c-main">

          @yield('content')

        </main>
        @include('dashboard.shared.footer')
      </div>
    </div>
    <script src="{{asset('lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('lib/numeral/numeral.min.js') }}"></script>
    <script src="{{ asset('lib/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('lib/iziToast/iziToast.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('flash_message'))
        let level = "{{ Session::get('flash_level') }}";
        let message = "{{ Session::get('flash_message') }}";
        switch (level) {
            case 'success':
                iziToast.success({
                    title: "{{__('base.success')}}",
                    message: message,
                    position: 'topRight'
                });
                break;
            case 'warning':
                iziToast.warning({
                    title: "{{__('base.warning')}}",
                    message: message,
                    position: 'topRight'
                });
                break;
            case 'error':
                iziToast.error({
                    title: "{{__('base.error')}}",
                    message: message,
                    position: 'topRight',
                });
                break;
            default:
                break;
        }
            @if(Session::has('flash_field'))
                let field = "{{ Session::get('flash_field') }}";
                let field_message = "{{ Session::get('flash_field_message') }}";
                $(`.text-danger.${field}`).text(field_message);
            @endif
        @endif

        @if (Session::has('alert_message'))
        let level = "{{ Session::get('alert_level') }}";
        let message = "{{ Session::get('alert_message') }}";
        switch (level) {
            case 'success':
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                        });
                break;
            default:
                break;
        }
        @endif

    </script>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('javascript')
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>

  </body>
</html>
