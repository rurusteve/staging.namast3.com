<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">
    <link rel="icon" href="https://my.namast3.com/laravel/public/faviconsolis.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/datetimepicker.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/additional.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <style>
        * {
            font-family: 'Rubik', sans-serif;

        }
        .fa-smile-wink:before{
            color: white;
        }

        i {
            min-width: 20px;
            text-align: center;
        }

        .modal-content {
            background-color: #f8f9fa !important;
        }

        button {
            margin: 5px 5px 5px 0;
        }

        body {
            background-color: whitesmoke;
            overflow: scroll;
        }

        a:hover {
            text-decoration: none !important;
        }

        html, body {
            /*background: url(https://solis.rurusteve.com/joanna-kosinska-129039-unsplash.jpg);*/
            background-image: linear-gradient(to bottom right, rgba(251, 254, 255, 0.97), rgba(162, 164, 165, 0.29));
            background-size: contain;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            min-height: 100vh;
            margin: 0;
        }

    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
    <style type="text/css">
        .chosen-container-active.chosen-with-drop .chosen-single {
            border: 1px solid #aaa;
            background-image: none;
            box-shadow: none;
        }

        a:not([href]):not([tabindex]) {
            color: inherit;
            text-decoration: none;
        }

        a:not([href]):not([tabindex]) {
            color: inherit;
            text-decoration: none;
        }

        .chosen-container-active .chosen-single {
            border: 1px solid #5897fb;
            box-shadow: none;
        }

        .chosen-container-single .chosen-single {
            position: relative;
            display: block;
            overflow: hidden;
            padding: 0 0 0 8px;
            height: calc(2.25rem + 2px);
            border: 1px solid #aaa;
            border-radius: 5px;
            background-color: #fff;
            background: none;
            background-clip: padding-box;
            box-shadow: none;
            color: #444;
            text-decoration: none;
            white-space: nowrap;
            line-height: calc(2.25rem);
        }

        .chosen-container-single .chosen-single div {
            position: absolute;
            top: 6px;
        }
    </style>

</head>
<body id="body">
<div id="app">
    {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="margin-bottom: 1.7rem">--}}
        {{--<div class="container">--}}
            {{--<a style="" class="navbar-brand" href="{{ url('/home') }}">--}}
                {{--<h2 style="font-family: Calibri"><img height="30px" src="http://my.namast3.com/logo.png"><img--}}
                            {{--height="40px" src="https://my.namast3.com/msid.png"></h2>--}}
            {{--</a>--}}

            {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
                    {{--aria-controls="navbarSupportedContent" aria-expanded="false"--}}
                    {{--aria-label="{{ __('Toggle navigation') }}">--}}
                {{--<span class="navbar-toggler-icon"></span>--}}
            {{--</button>--}}

            {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                {{--<!-- Left Side Of Navbar -->--}}
                {{--<ul class="navbar-nav mr-auto">--}}

                {{--</ul>--}}

                {{--<!-- Right Side Of Navbar -->--}}
                {{--<ul class="navbar-nav ml-auto">--}}

                    {{--<!-- Authentication Links -->--}}
                    {{--@guest--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                        {{--</li>--}}

                    {{--@else--}}


                        {{--<li class="nav-item dropdown">--}}
                            {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
                               {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                            {{--</a>--}}

                            {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                                {{--<a class="dropdown-item" href="{{ url('/home') }}"><i class="fas fa-home"></i> Home</a>--}}
                            {{--@if(Auth::user()->admin == 0 || Auth::user()->admin == 1)--}}
                                {{--@if(Auth::user()->logintype == 'professionalaudit' )--}}

                                    {{--<!-- <a class="dropdown-item" href="{{ url('/input/timereport') }}"><i--}}
                                            {{--class="fas fa-user-clock"></i> Time Report</a> -->--}}
                                        {{--<a class="dropdown-item" href="{{ url('/timesheets') }}"><i--}}
                                                    {{--class="fas fa-user-clock"></i> Time Sheets</a>--}}

                                    {{--@else--}}
                                    {{--@endif--}}


                                    {{--<a class="dropdown-item" href="{{ url('/input/cuti/home') }}"><i--}}
                                                {{--class="fas fa-location-arrow"></i> Cuti</a>--}}

                                {{--@elseif(Auth::user()->admin == 2)--}}

                                    {{--<a class="dropdown-item" href="{{ url('/partner/reporting/payrolldata') }}"><i--}}
                                                {{--class="fas fa-table"></i> Reports</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/adminrequestleavelist') }}"><i--}}
                                                {{--class="fas fa-suitcase-rolling"></i> On Leave Requests</a>--}}
                                {{--@endif--}}
                                {{--@if(Auth::user()->admin == 1)--}}
                                    {{--@if(Auth::user()->division == 'HRD' )--}}

                                        {{--<a class="dropdown-item" href="{{ url('/partner/reporting/payrolldata') }}"><i--}}
                                                    {{--class="fas fa-table"></i> Reports</a>--}}

                                    {{--@else--}}
                                    {{--@endif--}}
                                {{--@endif--}}
                                {{--@if(Auth::user()->division == 'HRD' )--}}
                                    {{--<a class="dropdown-item" href="/administration/timereport/tasks">--}}
                                        {{--<i class="fas fa-stream"></i> Tasks--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="/approveddeclinedlist">--}}
                                        {{--<i class="fas fa-vote-yea"></i> Approved List--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="/manualinput">--}}
                                        {{--<i class="fas fa-pencil-alt"></i> On Leave Editor--}}
                                    {{--</a>--}}

                                {{--@elseif(Auth::user()->division == 'SEKRETARIS' )--}}
                                    {{--<a class="dropdown-item" href="{{ url('/administration/timereport/clients') }}"><i--}}
                                                {{--class="fas fa-briefcase"></i> Clients</a>--}}
                                {{--@endif--}}
                                {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                                   {{--onclick="event.preventDefault();--}}
                                                            {{--document.getElementById('logout-form').submit();">--}}
                                    {{--<i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}--}}
                                {{--</a>--}}


                                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
                                      {{--style="display: none;">--}}
                                    {{--@csrf--}}
                                {{--</form>--}}

                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@endguest--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</nav>--}}
</div>
    @yield('content')
</body>
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
</html>
