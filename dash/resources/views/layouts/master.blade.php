<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
        <!-- Bootstrap Core CSS -->
        <link href="{!! asset('libs/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
        <!-- toast CSS -->
        <link href="{!! asset('plugins/bower_components/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">
        <!-- morris CSS -->
        <link href="{!! asset('plugins/bower_components/morrisjs/morris.css') !!}" rel="stylesheet">
        <!-- animation CSS -->
        <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
        <!-- color CSS -->
        <link href="{!! asset('css/colors/blue-dark.css') !!}" id="theme" rel="stylesheet">
    </head>
    <body>

        @section('header')
          <!--  <a href="{{ route('user.index') }}">Home</a> -->


        @if(Session::has('flash_message'))
            <div style="color:green; border:1px solid #aaa; padding:4px; margin-top:10px">
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @if($errors->any())
            <div style="color:red; border:1px solid #aaa; padding:4px; margin-top:10px">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div>
            @yield('content')
        </div>

        <div>
            Footer @ 2016
        </div>
    </body>
</html>
