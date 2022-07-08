<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Time Report</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/jqueryui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="http://www.solis.co.id/favicon.ico">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .ui-datepicker td span, .ui-datepicker td a {
            text-align: center;
            border-radius: 30px;
            color: #555555 !important;
        }

        .ui-datepicker th {
            padding: 10px 0;
            font-weight: normal;
        }

        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-widget-header {
            border-color: transparent !important;
            background: transparent !important;
            font-weight: normal;
        }

        .ui-state-default:hover, .ui-widget-content:hover .ui-state-default:hover, .ui-widget-header:hover .ui-state-default:hover {
            background: powderblue !important;
        }

        .ui-datepicker-week-end span {
            color: #e3342f !important;
        }

        .ui-datepicker th span {
            color: lightgrey;
        }

        .ui-datepicker {
            border-radius: 20px;
            border: none;
        }

        .form-control {
            display: inline;
            width: auto;
        }
    </style>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="margin-bottom: 1.7rem">
        <div class="container">
            <a style="vertical-align: center" class="navbar-brand" href="{{ url('/') }}">
                <img width="80px" src="http://www.solis.co.id/images/logo.png">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    <!--<li class="nav-item">
                                @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>-->
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{'/account/'.Auth::user()->id}}">Account</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a style="float: left;" href="/administration/timereport/clients">Clients List</a>
                    <a style="float: right" href="/administration/timereport/tasks">Tasks List</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Client Name</th>
                            <th>Engagement Period</th>
                        </tr>

                        </thead>
                        <tbody>
                        {{--@foreach($employees as $employee)--}}
                        @foreach($clients as $client)
                            <tr>
                                {{--<td>{{ (($clients->currentPage() - 1 ) * $clients->perPage() ) + $loop->iteration }}</td>--}}
                                <td>1</td>
                                <td>{{ $client -> clientname }}</td>
                                <td>

                                    <a href="{{ url('') }}">
                                        <button onclick="return confirm('Are you sure?')"
                                                class='btn btn-xs btn-outline-danger' style="border-radius: 50%"
                                                type='submit'
                                                data-toggle="tooltip" data-placement="top"
                                                title="Batalkan permintaan cuti"
                                                data-target="#confirmDelete" data-title="Delete User"
                                                data-message='Are you sure you want to delete this user ?'>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </a>
                                    <button class='btn btn-xs btn-outline-primary' style="border-radius: 50%"
                                            type='submit' data-toggle="modal"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Lihat detail ajuan cuti"
                                            data-target="#confirmDelete" data-title="Delete User"
                                            data-message='Are you sure you want to delete this user ?'>
                                        <i class="fas fa-search-plus"></i>
                                    </button>
                                    @include('deleteconfirm')
                                </td>

                            </tr>
                        @endforeach
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</body>

</html>
