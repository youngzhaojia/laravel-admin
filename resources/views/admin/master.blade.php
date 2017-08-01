<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | Bask</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('libs/adminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('libs/adminLTE/dist/css/skins/skin-blue.min.css') }}">

    <link href="{{ asset('libs/simple-pagination/simplePagination.css') }}" rel="stylesheet" type="text/css"/>

    @yield('css')

    @yield('head')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('pageHeader')
                <small>@yield('pageDesc')</small>
            </h1>
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                {{--<li class="active">Here</li>--}}
            {{--</ol>--}}
        </section>

        <section class="content container-fluid">
            @yield('content')
        </section>
    </div>

    @include('admin.layouts.footer')

    <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('libs/adminLTE/dist/js/adminlte.min.js') }}"></script>

<!-- young libs -->
<script src="{{ asset('bower_components/jquery-form/dist/jquery.form.min.js') }}"></script>
<script src="{{ asset('libs/jquery.confirm/jquery.confirm.min.js') }}"></script>
<script src="{{ asset('libs/simple-pagination/jquery.simplePagination.js') }}"></script>
<script src="{{ asset('bower_components/art-template/lib/template-web.js') }}"></script>

<script src="{{ asset('js/bask.js?id=1324453') }}"></script>
@yield('js')
</body>
</html>
