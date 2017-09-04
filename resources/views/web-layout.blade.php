<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>PT. Primanata Jasa Persada</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
        
        <!-- Google Font -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Karla:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />

        <!-- REVOLUTION BANNER CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/rs-plugin/css/settings.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropdown.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
        <link href="{{ asset('assets/css/skin.less" rel="stylesheet/less') }}">

    </head>
    <body>
        <!-- Loader Starts here -->
        <div class="loader-block">
                <div class="loader">
                        Loading...
                </div>
        </div>
        
        <div id="wrapper" class="homepage">
            
            @include('web.header') 
            
            @yield('content')
            
            @include('web.footer') 
            
        </div>
        
        <script type="text/javascript" src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/less.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.selectbox-0.2.min.js') }}"></script>

        <!--Parrallax -->
        <script type="text/javascript" src="{{ asset('assets/js/parallax.js') }}"></script>
        
        @yield('custom_js')

        <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('assets/js/site.js') }}"></script>
        
    </body>
</html>


