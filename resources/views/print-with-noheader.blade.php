<html>
    <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' media="all">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet">-->
        <link href="{{asset('print/style.css')}}" rel="stylesheet" type='text/css' media="all">
        <!--<link rel="stylesheet" type="text/css" media="print,handheld" href="{{asset('print/style.css')}}"/>-->
    </head>
    <body>
        <div id="main">
            
            @yield('content')

        </div>
    </body>
</html>