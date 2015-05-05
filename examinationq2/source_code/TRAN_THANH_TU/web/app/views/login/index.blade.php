<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>TTV - Login Form</title>
    {{HTML::style('assets/css/style.css')}}
</head>
<body>
<div class="w-container">
    <div class="w-form">
        {{Form::open(['id' => 'wf-form-Login-Form', 'name' => "wf-form-Login-Form", 'route' => 'login-post'])}}
            <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
                <div class="w-container">
                    <a class="w-nav-brand" href="#"></a>
                    <nav class="w-nav-menu" role="navigation"><a class="w-nav-link" href="{{URL::route('login-index')}}">Home</a>
                    </nav>
                    <div class="w-nav-button">
                        <div class="w-icon-nav-menu"></div>
                    </div>
                </div>
            </div>
            <h1>Login</h1>
            <label for="UserName">Username:</label>
            {{Form::text('username', '', ['class' => 'w-input', 'id' => 'UserName', 'placeholder' => 'Enter your username', 'required' => 'required'])}}
            <label for="Password">Password:</label>
            {{Form::password('password', ['class' => 'w-input', 'id' => 'Password', 'placeholder' => 'Enter your password', 'required' => 'required'])}}
            <div class="w-row">
                <div class="w-col w-col-6"></div>
                <div class="w-col w-col-6">
                    {{Form::submit('Login', ['class' => 'w-button'])}}
                </div>
            </div>
        </form>
        <div class="w-form-done">
            <p>Thank you! Your submission has been received!</p>
        </div>
        <div class="w-form-fail">
            <p>Oops! Something went wrong while submitting the form :(</p>
        </div>
    </div>
</div>

</body>
</html>