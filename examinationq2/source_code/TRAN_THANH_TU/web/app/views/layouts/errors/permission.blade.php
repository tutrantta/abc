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
    <!-- Custom CSS -->
    {{HTML::style('assets/css/errors.css')}}
    <style type="text/css" media="screen">
      
</style>
</head>
<body>
    <div class="container">
        @yield('content')
        <hr/>
        <h6 class="text-center">TCTAV 1.0.0</h6>
        <h6 class="text-center">© 2015 TCTAV, Inc. All rights reserved.</h6>
    </div>
</body>
</html>
