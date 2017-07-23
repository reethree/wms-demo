<html>
    <head>
        <title>@yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' media="all">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet">-->
        <link href="{{asset('print/style.css')}}" rel="stylesheet" type='text/css' media="all">
    </head>
    <body>
        <div>
            <div>
                <h2 class="name">PT. PRIMANATA JASA PERSADA</h2>
                <div>Jl. Enggano No. 40 E Jakarta 14310 - Indonesia</div>
                <div>Tel. (021) 43932076-77, (021) 43909872-73 &nbsp;Fax. (021) 43932087</div>
                <div>Email : <a href="mailto:primanatajp@yahoo.co.id">primanatajp@yahoo.co.id</a></div>
                <hr />
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="main">
            
            @yield('content')

        </div>
    </body>
</html>