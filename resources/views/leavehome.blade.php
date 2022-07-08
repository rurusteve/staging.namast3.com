@extends('layouts.app')
@section('title', 'Namaste')

@section('content')
    <style>
        .btn{
            padding: .375rem .75rem !important;
        }
        .sidebar {
            box-shadow: 0 5px 18px -22px rgba(0, 0, 0, 0.56), 0 4px 1px 0px rgba(0, 0, 0, 0.12), 0 8px 15px -5px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .nav-item:hover {
            cursor: pointer;
        }

        .sidebar .logo {
            height: 100px;
        }
        body {
            background-image: url('/svg/stairs.svg');
            background-size: cover;
        }

        .badge {
            margin-bottom: 10px;
            margin-right: 10px;
        }

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

        a:hover {
            text-decoration: none;
        }

        .status {
            border: 1px lightgrey solid;
            padding: 10px 15px;
            margin: 5px 0;
            font-weight: bold;
        }

    </style>

    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class="card-title">Status Cuti</h5>
                                <p class="card-category">Detail daftar cuti yang diajukan</p>
                            </div>
                            <div class="card-header">
                                <a style="float: left;" href="/input/cuti/home"><i
                                            class="fas fa-arrow-circle-left"></i> Status Cuti</a>
                                <a style="float: right" href="/input/cuti/pengajuancuti">Pengajuan Cuti <i
                                            class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            @if (session('alert'))
                                <div class="alert alert-danger">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            @if (session('successalert'))
                                <div class="alert alert-success">
                                    {{ session('successalert') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="status">Jatah cuti: {{ $jatahcutiawal }}</div>
                                        <div class="status">Penambahan: {{ $manualinputcutiplus }}</div>
                                        <div class="status">Pengurangan: {{ $manualinputcutiminus }}</div>
                                        <div class="status">Cuti yang sudah diambil: {{ $approvedrequest }}</div>
                                        {{--<div class="status">Cuti yang sudah diambil: {{ $approvedrequest }}</div>--}}
                                        <div class="status">Cuti tersedia: {{ $availableleave }}</div>
                                        {{--<div class="status">Penambahan & Pengurangan: {{ $manualinputcuti }}</div>--}}
                                    </div>
                                </div>
                                {{--<div class="alert alert-danger" role="alert">--}}
                                {{--Dear {{ Auth::user()->name }}, sisa cuti anda tersisa  {{ $availableleavethree }}--}}
                                {{--</div>--}}
                                <br>
                                <table class="table table-responsive-lg table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Jumlah Hari</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    {{--@foreach($employees as $employee)--}}
                                    @if($countrequest > 0)
                                        @foreach($leaverequests as $leaverequest)

                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($leaverequest->created_at)) }}</td>
                                                <td>{{ $leaverequest -> jumlahhari }}</td>
                                                <td>
                                                    @if($leaverequest->statuscuti == null)
                                                        <span style="color: blue;"><i class="fas fa-circle"></i> Menunggu</span>
                                                    @elseif($leaverequest->statuscuti == 'approved')
                                                        <span style="color: green;"><i class="fas fa-check-circle"></i> Disetujui</span>
                                                    @elseif($leaverequest->statuscuti == 'declined')
                                                        <span style="color: red;"><i class="fas fa-times-circle"></i> Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($leaverequest -> statuscuti == 'approved' || $leaverequest -> statuscuti == 'declined')
                                                        <a href="{{ url('/input/cuti/home/'.$leaverequest->id.'/detail') }}">
                                                            <button class='btn btn-xs btn-outline-primary'
                                                                    style="border-radius: 50%"
                                                                    type='submit'
                                                                    data-toggle="tooltip" data-placement="top">
                                                                <i class="fas fa-search-plus"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('/input/cuti/home/'.$leaverequest->id.'/delete') }}">
                                                            <button onclick="return confirm('Are you sure?')"
                                                                    class='btn btn-xs btn-outline-danger'
                                                                    style="border-radius: 50%"
                                                                    type='submit'
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Batalkan permintaan cuti"
                                                                    data-target="#confirmDelete">
                                                                {{--data-title="Delete User"--}}
                                                                {{--data-message='Are you sure you want to delete this user ?'>--}}
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('/input/cuti/home/'.$leaverequest->id.'/detail') }}">
                                                            <button class='btn btn-xs btn-outline-primary'
                                                                    style="border-radius: 50%"
                                                                    type='submit' data-toggle="modal"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Lihat detail ajuan cuti">
                                                                <i class="fas fa-search-plus"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                    @include('deleteconfirm')
                                                </td>

                                            </tr>
                                        @endforeach

                                    @elseif($countrequest == 0)
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: grey;">Data pengajuan
                                                cuti
                                                kosong
                                            </td>
                                        </tr>
                                    @endif

                                    {{--@endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js')}}"></script>
    <script src="{{ asset('js/core/popper.min.js')}}"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js')}}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('js/plugins/moment.min.js')}}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('js/plugins/sweetalert2.js')}}"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('js/plugins/jquery.validate.min.js')}}"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('js/plugins/jquery.bootstrap-wizard.js')}}"></script>
    <!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="{{ asset('js/plugins/jquery.dataTables.min.js')}}"></script>
    <!--    Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('js/plugins/bootstrap-tagsinput.js')}}"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('js/plugins/jasny-bootstrap.min.js')}}"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('js/plugins/fullcalendar.min.js')}}"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('js/plugins/jquery-jvectormap.js')}}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/plugins/nouislider.min.js')}}"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js')}}"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('js/plugins/arrive.min.js')}}"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE')}}"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('js/plugins/chartist.min.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/plugins/bootstrap-notify.js')}}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-dashboard.js?v=2.1.1" type="text/javascript')}}"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('demo/demo.js')}}"></script>

    <script>
        $(document).ready(function () {
            $().ready(function () {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                    if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                    }

                }

                $('.fixed-plugin a').click(function (event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function () {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function () {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function () {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function () {
                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function () {
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function () {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function () {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                    } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function () {
                            $('body').addClass('sidebar-mini');

                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function () {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function () {
                        clearInterval(simulateWindowResize);
                    }, 1000);

                });
            });
        });
    </script>
@endsection