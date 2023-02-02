<div style="background-color: #fff; z-index: 99" class="sidebar-wrapper">

    <ul class="nav">
        @guest
        @else




        @if(Auth::user()->admin == 0 || Auth::user()->admin == 1)
        <li class="nav-item "><a class="nav-link" href="{{ url('cuti/home') }}"><i
                        class="fas fa-location-arrow"></i>
                <p> Cuti</p></a></li>
        {{-- @if(Auth::user()->logintype !== 'nonprofessional' ) --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/timesheets/main') }}">
                <i class="fas fa-user-clock"></i>
                <p> Time Reports</p>
            </a>
        </li>
        {{-- @else
        @endif --}}


        @elseif(Auth::user()->admin == 2)
        @if(Auth::user()->division == 'HRD')
        <li class="nav-item "><a class="nav-link" href="{{ url('cuti/home') }}"><i
                        class="fas fa-location-arrow"></i>
                <p> Cuti</p></a></li>
        @else
        @endif

        <li class="nav-item "><a class="nav-link" href="{{ url('/adminrequestleavelist') }}"><i
                        class="fas fa-suitcase-rolling"></i>
                <p> On Leave Requests</p></a></li>
        @endif
        @if(Auth::user()->division == 'PARTNER' )

        <li class="nav-item">
            <a class="nav-link rotate"
               data-toggle="collapse"
               data-target="#collapseLinks" aria-expanded="false"
               aria-controls="collapseLinks" id="accordionExampleLinks">
                <p><i class="fas fa-table"></i> Reports <i style="margin-right: 0; float: right;"
                                                           id="rotateit"
                                                           class="fas fa-caret-right"></i></p>
            </a>
            <div id="collapseLinks" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionExampleLinks">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('partner/reporting/payrolldata') }}">Payroll
                            Master</a><br>
                        <a class="filterlink" href="{{ url('partner/reporting/payrollhistory') }}">Payroll
                            Summary</a><br>
                            <a class="filterlink" href="{{ url('partner/reporting/greenformula') }}">Green Formula
                            </a><br>
                        <a style="display: none;"
                           href="">{{ $monthss = \Carbon\Carbon::now()->month }}</a>
                        <a class="filterlink"
                           href="{{ url('partner/reporting/biodata') }}">Biodata</a><br>
                        <a class="filterlink" href="{{ url('partner/reporting/timereport') }}">Time
                            Report</a><br>
                        <a class="filterlink"
                           href="{{ url('partner/reporting/advanced/') }}">Totals</a><br><br>

                    </div>
                </div>
            </div>
            @yield('reports')
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="/leave/list">
                <i class="fas fa-vote-yea"></i>
                <p> Leave Request List</p>
            </a>
        </li>
        @elseif(Auth::user()->division == 'HRD' )
        @if(Auth::user()->admin == 1 || Auth::user()->admin == 2)
        <li class="nav-item">
            <a class="nav-link rotate"
               data-toggle="collapse"
               data-target="#collapseLinks" aria-expanded="false"
               aria-controls="collapseLinks" id="accordionExampleLinks">
                <p><i class="fas fa-table"></i> Reports <i style="margin-right: 0; float: right;"
                                                           id="rotateit"
                                                           class="fas fa-caret-right"></i></p>
            </a>
            <div id="collapseLinks" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionExampleLinks">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('partner/reporting/payrolldata') }}">Payroll
                            Database</a><br>
                        <a class="filterlink" href="{{ url('partner/reporting/payrollhistory/2022') }}">Payroll
                            History</a><br>
                        <a style="display: none;"
                           href="">{{ $monthss = \Carbon\Carbon::now()->month }}</a>
                        <a class="filterlink" href="{{ url('partner/reporting/greenformula') }}">Green Formula
                            </a><br>
                        <a class="filterlink"
                           href="{{ url('partner/reporting/biodata') }}">Biodata</a><br>
                        <a class="filterlink" href="{{ url('partner/reporting/timereport') }}">Time
                            Report</a><br>
                        <a class="filterlink"
                           href="{{ url('partner/reporting/advanced/') }}">Totals</a><br><br>

                    </div>
                </div>
            </div>
            @yield('reports')
        </li>
        <li class="nav-item">
            <a class="nav-link rotatetwo"
               data-toggle="collapse"
               data-target="#collapsePayroll" aria-expanded="false"
               aria-controls="collapsePayroll" id="accordionPayroll">
                <p><i class="fas fa-hand-holding-usd"></i> Payrolls
                    <i style="margin-right: 0; float: right;" id="rotateittwo"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapsePayroll" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionPayroll">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/payroll/history') }}">Payroll
                            History</a><br>
                        <a class="filterlink" href="{{ url('/payroll/run/') }}">Run Payroll</a><br>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link rotateleaves"
               data-toggle="collapse"
               data-target="#collapseLeaves" aria-expanded="false"
               aria-controls="collapseLeaves" id="accordionLeaves">
                <p><i class="fas fa-vote-yea"></i> Leaves
                    <i style="margin-right: 0; float: right;" id="rotateitleaves"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapseLeaves" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionLeaves">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/manualinput') }}">Leave Editor</a><br>
                        <a class="filterlink" href="{{ url('/leave/list') }}">Leave Request List</a><br>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link rotateusers"
               data-toggle="collapse"
               data-target="#collapseusers" aria-expanded="false"
               aria-controls="collapseusers" id="accordionusers">
                <p><i class="fas fa-users"></i> Employees
                    <i style="margin-right: 0; float: right;" id="rotateitusers"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapseusers" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionusers">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/payroll/data') }}">Main Data</a><br>
                        {{--<a class="filterlink" href="{{ url('/user/registration/form') }}">Add--}}
                            {{--Employee</a><br>--}}
                        {{--<a class="filterlink" href="{{ url('/user/biodata/form') }}">Add Biodata</a><br>--}}
                        <a class="filterlink" href="{{ url('/biodata/home') }}">Biodata</a><br>
                        <a class="filterlink" href="{{ url('/user/list') }}">Registered User
                            List</a><br>
                        <a class="filterlink" href="{{ url('/teammanagement') }}">Manage Team</a><br>
                        <a class="filterlink" href="{{ url('/administration/timereport/tasks') }}">Tasks</a><br>
                        <a class="filterlink" href="{{ url('/team/groups') }}">Groups</a><br>
                        <a class="filterlink" href="{{ url('/administration/timereport/divisions') }}">Divisions</a><br>
                        {{-- <a class="filterlink" href="{{ url('/team/delegations') }}">Delegations</a><br> --}}
                        <a class="filterlink" href="{{ url('/administration/timereport/clients/msid') }}">Clients</a><br>
                    </div>
                </div>
            </div>
        </li>

        @else
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link rotate"-->
        <!--       data-toggle="collapse"-->
        <!--       data-target="#collapseLinks" aria-expanded="false"-->
        <!--       aria-controls="collapseLinks" id="accordionExampleLinks">-->
        <!--        <p><i class="fas fa-table"></i> Reports <i style="margin-right: 0; float: right;"-->
        <!--                                                   id="rotateit"-->
        <!--                                                   class="fas fa-caret-right"></i></p>-->
        <!--    </a>-->
        <!--    <div id="collapseLinks" class="collapse" aria-labelledby="headingLinks"-->
        <!--         data-parent="#accordionExampleLinks">-->
        <!--        <div class="card-body">-->
        <!--            <div class="filterlist">-->
        <!--                <a class="filterlink" href="{{ url('partner/reporting/timereport') }}">Time-->
        <!--                    Report</a><br>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
            @yield('reports')
        </li>
        <li class="nav-item">
            <a class="nav-link rotateleaves"
               data-toggle="collapse"
               data-target="#collapseLeaves" aria-expanded="false"
               aria-controls="collapseLeaves" id="accordionLeaves">
                <p><i class="fas fa-vote-yea"></i> Leaves
                    <i style="margin-right: 0; float: right;" id="rotateitleaves"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapseLeaves" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionLeaves">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/manualinput') }}">Leave Editor</a><br>
                        <a class="filterlink" href="{{ url('/leave/list') }}">Leave Request List</a><br>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link rotateusers"
               data-toggle="collapse"
               data-target="#collapseusers" aria-expanded="false"
               aria-controls="collapseusers" id="accordionusers">
                <p><i class="fas fa-users"></i> Employees
                    <i style="margin-right: 0; float: right;" id="rotateitusers"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapseusers" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionusers">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/user/list') }}">Registered User
                            List</a><br>
                        <a class="filterlink" href="{{ url('/teammanagement') }}">Manage Team</a><br>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="/administration/timereport/tasks">
                <i class="fas fa-stream"></i>
                <p> Tasks</p>
            </a>
        </li>
        @endif
        @elseif(Auth::user()->division == 'SEKRETARIS' )
           <li class="nav-item">
            <a class="nav-link rotateusers"
               data-toggle="collapse"
               data-target="#collapseusers" aria-expanded="false"
               aria-controls="collapseusers" id="accordionusers">
                <p><i class="fas fa-users"></i> Management
                    <i style="margin-right: 0; float: right;" id="rotateitusers"
                       class="fas fa-caret-right"></i>
                </p>
            </a>
            <div id="collapseusers" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionusers">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('/administration/timereport/clients/msid') }}">Clients</a><br>
                        <a class="filterlink" href="{{ url('/teammanagement') }}">Teams</a><br>
                        {{-- <a class="filterlink" href="{{ url('/team/delegations') }}">Delegations</a><br> --}}
                    </div>
                </div>
            </div>
        </li>
        @endif

         <li class="nav-item">
            <a class="nav-link rotatepayslips"
               data-toggle="collapse"
               data-target="#collapsePayslips" aria-expanded="false"
               aria-controls="collapsePayslips" id="accordionPayslips">
                <p><i class="fas fa-scroll"></i> Slip Gaji
                <!--<span style="padding: 4px 7px; background-color: red; color: white; font-weight: bold; border-radius: 5px; ">New</span>-->
                <i style="margin-right: 0; float: right;"
                                                           id="rotateitpayslips"
                                                           class="fas fa-caret-right"></i></p>
            </a>
            <div id="collapsePayslips" class="collapse" aria-labelledby="headingLinks"
                 data-parent="#accordionPayslips">
                <div class="card-body">
                    <div class="filterlist">
                        <a class="filterlink" href="{{ url('payslips/2023') }}">2023</a><br>
                        <a class="filterlink" href="{{ url('payslips/2022') }}">2022</a><br>
                        <a class="filterlink" href="{{ url('payslips/2021') }}">2021</a><br>
                        <a class="filterlink" href="{{ url('payslips/2020') }}">2020</a><br>
                        <a class="filterlink" href="{{ url('payslips/2019') }}">2019</a><br>

                        <br>

                    </div>
                </div>
            </div>
        </li>



        <!--<li class="nav-item ">-->
        <!--    <a class="nav-link" href="/news">-->
        <!--        <i class="fas fa-bullhorn"></i>-->
        <!--        <p>Announcement-->
        <!--            {{--<span style="padding: 4px 7px; background-color: red; color: white; font-weight: bold; border-radius: 5px; ">New</span>--}}-->
        <!--        </p>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                <i style="padding-right: 5px"
                   class="fas fa-sign-out-alt"></i> {{ __(' Logout') }}
            </a>
        </li>


        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>

        @endguest

    </ul>
</div>
