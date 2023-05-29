@if(session('role_id'))
    <script>window.location = "{{ route('dashboard') }}";</script>
@endif
<!DOCTYPE html>
<html>

<head>
    {{-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css4/bootstrap.min.css" rel="stylesheet">
    <link href="css4/bootstrap-icons.css" rel="stylesheet">
    <link href="css4/styles.css" rel="stylesheet" />
    <link href="css4/owl.carousel.min.css" rel="stylesheet" />
    <script src="js4/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="js4/popper.min.js" type="text/javascript"></script>
    <script src="js4/bootstrap.min.js" type="text/javascript"></script>
    <script src="js4/owl.carousel.min.js" type="text/javascript"></script>

    {{-- <title>Rajasthan Fund | Login</title>
    <link href="/Content/bootstrap.min.css" rel="stylesheet">
    <link href="/Fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/Content/animate.css" rel="stylesheet">
    <link href="css/style.sel.css" rel="stylesheet"> --}}
  
</head>

<body>
    <div class="main_section login">
        <div class="container">
            <div class="login_inner">
                <form action="{{ url('login-user') }}" method="POST">
                    @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <div class="form_header">
                        <p>Rajasthan Relief Payment Fund</p>
                    </div>
                    <div class="form_body">
                        {{-- {{ session('valid') }} --}}
                        <span style="color: darkblue;font-weight: 600;margin-right: 226px;">Login with SSO</span>
                        <div class="form_row">
                            <div class="form_coll full">
                                <span class="input_icon"><i class="bi bi-person-fill"></i></span>
                                <input type="text" id="login_id" class="inputbox" name="UserName"
                                    placeholder="Enter Your UserName" required autofocus value="{{ old('UserName') }}">
                                {!! $errors->first('UserName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_coll full">
                                <span class="input_icon"><i class="bi bi-lock"></i></span>
                                <input type="Password" id="login_password" class="inputbox"
                                    placeholder="Enter Your Password" required name="Password">
                                {!! $errors->first('Password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_coll left">
                                <input type="checkbox" value="Remember Me" name="remember">
                                <span>Remember Me</span>
                            </div>
                            {{-- <div class="form_coll right">
                            <a href="#" class="forget_pass">Forget Password?</a>
                        </div> --}}
                        </div>
                        <div class="btn_row">
                            <button type="submit" class="primary_btn">Login</button>
                        </div>
                    </div>
                </form>
                {{-- <div class="other_link">
                <p>You don't have account? click on this link <a href="{{ url('registration') }}">Register</a></p>
            </div> --}}
            </div>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>
