<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="AdminLTE/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/iCheck/square/blue.css">
    <link rel="shortcut icon" href="" type="image/vnd.microsoft.icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="">{{ config('app.name') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('login') }}" method="post" spellcheck="false" autocomplete="on">
            {{ csrf_field() }}
            @include('admin.layouts.error')
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>  Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-xs-8">
                <a href="{{ route('password.request') }}" data-toggle="modal">I forgot my password</a>
            </div>
            <div class="col-xs-4 text-right">
                <a href="{{ route('register') }}" data-toggle="modal">Register</a>
            </div>
        </div>

    </div>
</div>

@include('admin.partial.js')
<script src="AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>