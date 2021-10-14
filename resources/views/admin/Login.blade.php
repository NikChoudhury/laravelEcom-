<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
    <style>
        #admin-login .error{
            color:red;
            margin-top: 5px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin">
                            </a>
                            <br>
                            {{Config::get('contants.SITE_NAME')}}
                        </div>
                        <div class="login-form">
                            <form action="{{route('admin.auth')}}" method="post" name="login" id="admin-login">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                                    <!-- <p class="text-danger mt-2">Please enter your email</p> -->
                                    @if($errors->has('email'))
                                        <p class="text-danger mt-2">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                    <!-- <p class="text-danger mt-2">Please enter your password</p> -->
                                    @if($errors->has('password'))
                                        <p class="text-danger mt-2">{{ $errors->first('password') }}</p>
                                    @endif

                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{session('error')}}
                            </div>
                            @endif
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                            @endif
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>

    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/main.js')}}"></script>
    <script src="{{asset('admin_assets/js/jquery.validate.min.js')}}"></script>
    <script>
        $(function(){
            $("form[name='login']").validate({
                rules:{
                    email:{
                        required:true,
                        email:true
                    },
                    password:{
                        required:true,
                    }
                },
                messages:{
                        email: {
                            required: "Please enter your Email !!",
                            email: "Please enter a valid email address"
                        },
                        password: "Please enter your password !!"
                }
            });
        });
    </script>

</body>

</html>
<!-- end document-->