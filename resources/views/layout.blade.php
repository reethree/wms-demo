<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $page_title or "Dashboard" }} | Administrator</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- JQuery-UI & JQgrid -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset("/plugins/jQuery-ui/jquery-ui.min.css") }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset("/plugins/jQgrid/css/ui.jqgrid.css") }}" />
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        
        @yield('custom_css')
        
        <!-- Theme style -->
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-black-light.min.css")}}" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.2.3 -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
        <!-- jQuery Masking -->
        <script src="{{ asset ("/bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js") }}"></script>
        
        <script src="{{ asset("/plugins/jQgrid/js/i18n/grid.locale-en.js") }}" type="text/javascript"></script>
        <script src="{{ asset("/plugins/jQgrid/js/jquery.jqGrid.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("/plugins/jQgrid/js/helper.js") }}" type="text/javascript"></script>
        
        <script>
            $(function () {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
            });
            
            function afterSubmitEvent(response, postdata)
            {
                //Parses the JSON response that comes from the server.
                result = JSON.parse(response.responseText);
                console.log(result);
                //result.success is a boolean value, if true the process continues,
                //if false an error message appear and all other processing is stopped,
                //result.message is ignored if result.success is true.
                return [result.success, result.message];
            }
        </script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black-light layout-top-nav">
        
        @include('partials.header')
        
        <div class="wrapper">

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height: 376px;">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                          {{ $page_title or "Access Denied" }}
                          <small>{{ $page_description or null }}</small>
                        </h1>
                        <ol class="breadcrumb">
                          <li><a href="{{ route('index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                          @if(isset($breadcrumbs))
                              @foreach($breadcrumbs as $breadcrum)
                                  @if($breadcrum['action'])
                                      <li><a href="{{ $breadcrum['action'] }}">{{ $breadcrum['title'] }}</a></li>
                                  @else
                                      <li class="active">{{ $breadcrum['title'] }}</li>
                                  @endif
                              @endforeach
                          @endif
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <!-- Your Page Content Here -->
                        @include('partials.alert') 
                        
                        @yield('content')
                    </section>
                  <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->
            
            @include('partials.footer')
            
        </div><!-- ./wrapper -->
        
        <!--TPS ONLINE MODAL-->
        <div id="tpsonline-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Upload TPS Online</h4>
                    </div>
                    <div class="modal-body">
                        <div id="tpsonline-modal-text"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <a href="#" id="tpsonline-send-btn" class="btn btn-primary">Kirim Sekarang</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- REQUIRED JS SCRIPTS -->

        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/fastclick/fastclick.js") }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
        
        @yield('custom_js')
        
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience -->
        <script>
            $(document).ready(function(){
                $('.dropdown-submenu a.submenu').on("click", function(e){
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
            });
        </script>
    </body>
</html>