<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('faviconsolis.ico') }}" rel="stylesheet">

    <title>Welcome, Solis | MSId</title>
    <link rel="icon" href="http://my.namast3.com/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            /*background: url(https://solis.rurusteve.com/payroll-background.jpg);*/
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right links" style="background-color: #ffffffdb; border-radius: 50px; padding: 10px 20px;">
        <!--<img style="padding: 0; margin: 0;" height="20px" src="http://my.namast3.com/logo.png">-->
       
    </div>

    <div class="content">

        @if (Route::has('login'))
            <div class="title m-b-md">
                Welcome
            </div>
            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    <!--<a href="{{ route('register') }}">Register</a>-->
                    @endauth
                </div>
            @endif
        @endif
    </div>
</div>
</body>
</html>
