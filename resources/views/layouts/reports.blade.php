@extends('layouts.app')
@section('title', 'Reports')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style>
    .collapse {
        visibility: unset;
    }
    .nav-item .card-body{
        margin: 0 15px;
        padding: 0 1.125rem;
    }
    input[type="search"]{
        padding: 0 0 0 20% !important;
    }
    @media screen and (min-width: 800px) {
        .table > tbody > tr > td:first-child {
            position: absolute;
            width: 210px;
            background-color: white;
        }
        .table > thead:first-child > tr:first-child > th:first-child {
            width: 210px !important;
            position: absolute;
            background-color: white;
            padding-top: 22px !important;
            z-index: 5;

        }
    }
</style>
@section('reports')

    @yield('contentfilter')
    @yield('contentreporthead')

@endsection
@section('content')
    <style>
        .caret {
            display: none !important;
        }

        .col-sm-6 {
            padding-left: 0 !important;
        }
        .row {
            padding: 10px 0;
        }

        .input-sm {
            margin: 0 10px;
        !important;
        }

        .jumbotron {
            background: #6b7381;
            color: #bdc1c8;
        }

        .jumbotron h1 {
            color: #fff;
        }

        .example {
            margin: 4rem auto;
        }

        .example > .row {
            margin-top: 2rem;
            height: 5rem;
            vertical-align: middle;
            text-align: center;
            border: 1px solid rgba(189, 193, 200, 0.5);
        }

        .example > .row:first-of-type {
            border: none;
            height: auto;
            text-align: left;
        }

        .example h3 {
            font-weight: 400;
        }

        .example h3 > small {
            font-weight: 200;
            font-size: 0.75em;
            color: #939aa5;
        }

        .example h6 {
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 3.32px;
            text-transform: uppercase;
            color: #bdc1c8;
            margin: 0;
            line-height: 5rem;
        }

        .example .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle:before {
            content: 'Off';
            left: -4rem;
        }

        .btn-toggle:after {
            content: 'On';
            right: -4rem;
            opacity: 0.5;
        }

        .btn-toggle > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }

        .btn-toggle.active:before {
            opacity: 0.5;
        }

        .btn-toggle.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            display: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            color: #6b7381;
        }

        .btn-toggle.active {
            background-color: #29b5a8;
        }

        .btn-toggle.btn-lg {
            margin: 0 5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 2.5rem;
            width: 5rem;
            border-radius: 2.5rem;
        }

        .btn-toggle.btn-lg:focus,
        .btn-toggle.btn-lg.focus,
        .btn-toggle.btn-lg:focus.active,
        .btn-toggle.btn-lg.focus.active {
            outline: none;
        }

        .btn-toggle.btn-lg:before,
        .btn-toggle.btn-lg:after {
            line-height: 2.5rem;
            width: 5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-lg:before {
            content: 'Off';
            left: -5rem;
        }

        .btn-toggle.btn-lg:after {
            content: 'On';
            right: -5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-lg > .handle {
            position: absolute;
            top: 0.3125rem;
            left: 0.3125rem;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 1.875rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-lg.active > .handle {
            left: 2.8125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-lg.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-sm:before,
        .btn-toggle.btn-lg.btn-sm:after {
            line-height: 0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.6875rem;
            width: 3.875rem;
        }

        .btn-toggle.btn-lg.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-lg.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-xs:before,
        .btn-toggle.btn-lg.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-sm {
            margin: 0 0.5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.2rem;
            width: 2.4rem;
            border-radius: 1.5rem;
        }

        .btn-toggle.btn-sm:focus,
        .btn-toggle.btn-sm.focus,
        .btn-toggle.btn-sm:focus.active,
        .btn-toggle.btn-sm.focus.active {
            outline: none;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: 1.3rem;
            width: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.55rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-sm:before {
            content: '';
            left: -0.5rem;
        }

        .btn-toggle.btn-sm:after {
            content: '';
            right: -0.5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-sm > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 0.8rem;
            height: 0.8rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-sm.active > .handle {
            left: 1.3875rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-sm:before,
        .btn-toggle.btn-sm.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-xs:before,
        .btn-toggle.btn-sm.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-xs {
            margin: 0 0;
            padding: 0;
            position: relative;
            border: none;
            height: 1rem;
            width: 2rem;
            border-radius: 1rem;
        }

        .btn-toggle.btn-xs:focus,
        .btn-toggle.btn-xs.focus,
        .btn-toggle.btn-xs:focus.active,
        .btn-toggle.btn-xs.focus.active {
            outline: none;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            line-height: 1rem;
            width: 0;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-xs:before {
            content: 'Off';
            left: 0;
        }

        .btn-toggle.btn-xs:after {
            content: 'On';
            right: 0;
            opacity: 0.5;
        }

        .btn-toggle.btn-xs > .handle {
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 0.75rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-xs.active > .handle {
            left: 1.125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-xs.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-sm:before,
        .btn-toggle.btn-xs.btn-sm:after {
            line-height: -1rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.275rem;
            width: 1.55rem;
        }

        .btn-toggle.btn-xs.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-xs.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-xs:before,
        .btn-toggle.btn-xs.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-secondary {
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle.btn-secondary:before,
        .btn-toggle.btn-secondary:after {
            color: #6b7381;
        }

        .btn-toggle.btn-secondary.active {
            background-color: #ff8300;
        }

        .filterlist {
            font-size: 0.8em;
        }

        .btn-toggle.btn-sm {
            margin: 5px 0;
        }

        .accordion .card-header {
            padding: 0;
            font-size: 0.6em !important;
            border-left: 0.6px solid #eceeee;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .filterlink {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: left;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border-left: 0.6px solid #eceeee;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.5;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;

        }

    </style>
    <div class="container">
        <div class="row justify-content-center">

            @yield('reportcontent')
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <style>
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
            bottom: 8px !important;
            top: auto !important;
        }

        table {
            transition: .3s cubic-bezier(.25, .8, .5, 1);
            user-select: none;
            white-space: nowrap;
        }

        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: .3rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3490dc;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .paginate_button:hover, .ellipsis:hover {
            background-color: #eceeec;
            cursor: pointer;
            color: #3490dc;
        }

        #example_previous {
            border-radius: 5px 0 0 5px;
        }

        #example_next {
            border-radius: 0 5px 5px 0;
        }

        div.dataTables_info {
            font-size: 0.8em;
            display: flex;
            justify-content: start;
            margin-bottom: 0;
        }

        .dataTables_filter {
            font-size: 0.8em;
        }

        @media screen and (max-width: 767px) {
            div.dataTables_info {
                justify-content: center;
                margin-bottom: 20px;
            }

        }




        @media screen and (min-width: 200px) {
            div.dataTables_info {
                justify-content: center;
                margin-bottom: 20px;
            }

            .table > tbody > tr > td:first-child {
                position: absolute;
                width: 200px;
                background-color: white;
            }
            .table > thead:first-child > tr:first-child > th:first-child {
                width: 200px !important;
                position: absolute;
                background-color: white;
                top: 0;
                z-index: 5;

            }
        }



        input {
            outline: none;
        }

        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 100%;
        }

        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none;
        }

        input[type=search] {
            font-size: 1em;
            background: #ededed url(http://rurusteve.com/search-solid.svg) no-repeat 9px center;
            background-size: 1em;

            border: solid 1px #ccc;
            padding: 9px 10px 9px 32px;
            width: 55px;

            -webkit-border-radius: 10em;
            -moz-border-radius: 10em;
            border-radius: 10em;

            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            transition: all .2s;
        }

        input[type=search]:focus {
            width: 130px;
            background-color: #fff;
            border-color: #fec834;

            -webkit-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            -moz-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
        }

        input:-moz-placeholder {
            color: #999;
        }

        input::-webkit-input-placeholder {
            color: #999;
        }

        .dataTables_length {
            font-size: 0.8em;
        }

        .collapse {
            visibility: unset;
        }

        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
            outline: none;
        }

        .btn-link:focus, .btn-link:hover {
            text-decoration: none;
            background-color: transparent;
        }

        .btn-link:hover {
            color: #5dbf41;
        }

        .caret {
            display: none;
        }

    </style>

    <script>
        $('.toggle-vis').on('click', function (e) {
            e.preventDefault();

            // Get the column API object
            var column = $('#example').DataTable().column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        })
    </script>
    <script>
        $(document).ready(function () {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#example').DataTable({
                    // scrollY:300,
                    // scrollX:true,
                    // scrollCollapse: true,
                    // paging:false,
                    // fixedColumns: true,
                    // fixedHeader: true,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }
            else{
                $('#example').DataTable({
                    // fixedColumns: {
                    //     leftColumns: 2
                    // },
                    // scrollY:        400,
                    // scrollX:        true,
                    // fixedColumns:   true,
                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#exampletwo').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }
            else{
                $('#exampletwo').DataTable({
                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }

            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
    <script>
        $(document).ready(function () {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#examplefour').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }
            else{
                $('#examplefour').DataTable({
                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }

            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
    <script>
        $(document).ready(function () {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#examplethree').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

                    oLanguage: {

                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }
            else{
                $('#examplethree').DataTable({
                    oLanguage: {
                        oPaginate: {
                            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                        }
                    },
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }

                });
            }

            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
    <style>
        .caret {
            display: none !important;
        }

    </style>
    <style>
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
            bottom: 8px !important;
            top: auto !important;
        }

        table {
            transition: .3s cubic-bezier(.25, .8, .5, 1);
            user-select: none;
            white-space: nowrap;
        }

        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: .3rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3490dc;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .paginate_button:hover, .ellipsis:hover {
            background-color: #eceeec;
            cursor: pointer;
            color: #3490dc;
        }

        #example_previous {
            border-radius: 5px 0 0 5px;
        }

        #example_next {
            border-radius: 0 5px 5px 0;
        }

        div.dataTables_info {
            font-size: 0.8em;
            display: flex;
            justify-content: start;
            margin-bottom: 0;
        }

        .dataTables_filter {
            font-size: 0.8em;
        }

        @media screen and (max-width: 767px) {
            div.dataTables_info {
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        input {
            outline: none;
        }

        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 100%;
        }

        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none;
        }

        input[type=search] {
            padding: .375rem .75rem;
        }

        input[type=search]:focus {
            width: 130px;
            background-color: #fff;
            border-color: #fec834;

            -webkit-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            -moz-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
        }

        input:-moz-placeholder {
            color: #999;
        }

        input::-webkit-input-placeholder {
            color: #999;
        }

        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
            outline: none;
        }

        .btn-link:focus, .btn-link:hover {
            text-decoration: none;
            background-color: transparent;
        }

        .btn-link:hover {
            color: #5dbf41;
        }

        .caret {
            display: none;
        }

        #example_length label {
            display: flex;
            align-items: center;
        }

        #example_length label select {
            max-width: 80px;
        }

        #example_filter {
            float: right;
            display: inline-block;

        }

        #example_filter label {
            display: flex;
            align-items: center;

        }


        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }

        i {
            min-width: 0;
        }

        #example_paginate {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        #example_length .custom-select {
            margin: 0 10px;

        }

        #example_length {
            display: inline-block;

        }

        @media screen and (max-width: 767px) {
            #example_filter {
                margin-top: 10px;
                float: left;
                display: block;
            }

            #example_length {
                display: block;
            }

            #example_paginate {
                display: flex;
                justify-content: center;
            }

        }


        div.dataTables_filter input {
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            float: left;
        }

        #example_length select {
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            float: left;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            margin: 0 5px;
        }

        .col-auto button, .col-auto select, #reportrange {
            margin: 5px 0;
        }
        #reportrange i{
            font-size: 20px;
            float: left;
            margin: 0;
            line-height: 30px;
            min-width: 5px;
            text-align: center;
            color: #a9afbb;
        }


        .table > tbody > tr:first-child {
            background-color: white;
        }

        .navbar>.container, .navbar>.container-fluid{
            justify-content: flex-end;
        }
        .table{
            font-size: 12px !important;
        }
        .form-control:focus{
            -webkit-background-size: 14px;
            background-size: 14px;
        }
        input[type=search]:focus{
            padding-left: 14%;
        }
        .table>tfoot>tr>th:nth-child(1){
            width: 200px !important;
        }
        .table>tfoot>tr>th:nth-child(1) select{
            width: 200px !important;
        }
        .table>tfoot>tr>th select{
            padding: 0 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
            background: none;
            border: none;
        }
        .table > tbody > tr > td:nth-child(2) {
            padding-left: 10px !important;
        }
        th, td { white-space: nowrap !important; }
        table.dataTable tfoot th, table.dataTable tfoot td {
            padding: 10px 0 6px 18px;
        }
        .dataTables_wrapper {
            overflow-x: scroll;
        }
    </style>
@endsection
