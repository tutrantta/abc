<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title', 'TAV - ETM')</title>
        <!-- Bootstrap Core CSS -->
        {{HTML::style('assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}
        <!-- MetisMenu CSS -->
        {{HTML::style('assets/plugins/metisMenu/dist/metisMenu.min.css')}}
        <!-- Bootstrap datetimepicker CSS -->
        {{HTML::style('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}
        <!-- DataTables CSS -->
        {{HTML::style('assets/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}
        {{HTML::style('assets/plugins/datatables-responsive/css/dataTables.responsive.css')}}
        <!-- Custom Fonts -->
        {{HTML::style('assets/plugins/font-awesome/css/font-awesome.min.css')}}
        <!-- Custom CSS -->
        {{HTML::style('assets/css/style.css')}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="wrapper">
            <!-- Header -->
            @include('layouts.header')
            <!-- /.header -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            @if (trim($__env->yieldContent('subTitle')))
                            @yield('subTitle')
                            @else
                            @yield('title')
                            @endif
                        </h1>
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- Main error -->
                @yield('error')
                <!-- Main content -->
                @yield('content')
                <!-- /.content -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        
        <!-- jQuery -->
        {{HTML::script('assets/plugins/jquery/dist/jquery.min.js')}}
        {{HTML::script('assets/js/jquery.validate.js')}}
        {{HTML::script('assets/js/scripts.js')}}
        <!-- Bootstrap Core JavaScript -->
        {{HTML::script('assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}
        {{HTML::script('assets/plugins/bootstrap/js/tooltip.js')}}
        <!-- Metis Menu Plugin JavaScript -->
        {{HTML::script('assets/plugins/metisMenu/dist/metisMenu.min.js')}}
        <!-- Custom Theme JavaScript -->
        {{HTML::script('assets/js/app.js')}}
        <!-- DataTables JavaScript -->
        {{HTML::script('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}
        {{HTML::script('assets/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}
        {{HTML::script('assets/plugins/datatables-plugins/api/fnSetFilteringDelay.js')}}
        <!-- Bootstrap datetimepicker JavaScript -->
        {{HTML::script('assets/plugins/bootstrap-datetimepicker/js/moment-with-locales.js')}}
        {{HTML::script('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}
        
        <script type="text/javascript">
            $(document).ready(function () {
                $(".alert").delay(10000).slideUp(200, function() {
                    $(this).alert('close');
                });
                $('[data-toggle=tooltip]').tooltip()
                $(document).on('mouseenter','[data-toggle=tooltip]', function () {$('[data-toggle=tooltip]').tooltip()})
                $('#datetimepicker').datetimepicker();
            });
        </script>

        @yield('script')
    </body>
</html>
