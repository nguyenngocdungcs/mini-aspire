<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="AdminLTE/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
    <link rel="shortcut icon" href="" type="image/vnd.microsoft.icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="">{{ config('app.name') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8 col-xs-offset-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
@include('admin.partial.js')
</body>
</html>