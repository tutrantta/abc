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
    {{HTML::style('assets/css/style.css')}}
    {{HTML::style('assets/css/main.css')}}
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 ta-img-logo">
                {{ HTML::image('/assets/img/tta_logo.png') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                {{ Helper::ShowErrorsMessage($errors) }}
                {{ Helper::ShowSuccessMessage() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Panel</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>'login-post','class'=>'form-signin']) }}
                        {{-- show error message --}}
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    {{ Form::text('username','',array('class' => 'form-control','placeholder'=>"username")) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                   {{ Form::password('password',array('class' => 'form-control','placeholder'=>"password")) }}
                               </div>
                           </div>
                           <!-- Change this to a button or input when using this as a form -->
                           {{ Form::submit('Login',array('class'=>"btn btn-lg btn-primary btn-block")) }}
                       </fieldset>
                       {{ Form::close() }}
                   </div>
               </div>
           </div>
       </div>
       <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="#">Forgot Password !</a>
        </div>
    </div>
    <hr/>
    <h6 class="text-center">TTV 1.0.0</h6>
    <h6 class="text-center">© 2015 TTV, Inc. All rights reserved.</h6>
</div>
<!-- /#wrapper -->
<!-- jQuery -->
{{HTML::script('assets/plugins/jquery/dist/jquery.min.js')}}
<!-- Bootstrap Core JavaScript -->
{{HTML::script('assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}
</body>
</html>
