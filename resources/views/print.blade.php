<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href="{{asset('bower_components/AdminLTE/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    </head>
    <body>

        <div class='container'>

            @yield('content')

        </div>
        
        <script>
            window.print();
        </script>

    </body>
</html>