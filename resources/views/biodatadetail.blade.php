@extends('layouts.app')
@section('title', 'Account Detail')
@section('heads')
    <link href="{{ asset('css/hoshi.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection
@section('content')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            border: none;
        }

        salary-table thead tr td {
            text-align: left;
        }

        salary-table tbody tr:nth-child(odd) {

        }

        salary-table tbody tr:nth-child(even) {

        }

        salary-table tbody tr td:nth-child(n+1) {
            text-align: right;
        }

        salary-table thead tr td:nth-child(2) {
            min-width: 80px;
        }

        salary-table thead tr td:nth-child(3) {
            min-width: 110px;
        }

        salary-table tbody tr td:nth-child(2), table tbody tr td:nth-child(3) {
            text-align: left;
        }

        #example_length {
            text-align: left;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ea4335">Main</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profilepicture">

                                <label>
                                    Profile Picture
                                </label>
                                @if($checkprofilepicture >= 1)
                                    <img width="200px" class="img-thumbnail"
                                         src="{{ Storage::url($profiles->picture) }}">
                                @elseif($checkprofilepicture == 0)
                                    <img src="{{ asset('avatar.jpg') }}" width="200px"
                                         class="img-thumbnail">
                                @endif
                                <form action="{{ url('/profilepicture/upload/'.$employees->nip.'/process') }}"
                                      method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}

                                    <div style="margin: 0;"
                                         class="form-group {{ !$errors->has('picture') ?: 'has-error' }}">
                                        <div style="line-height: 0; display: flex; flex-direction: column; width: 100%;"
                                             class="file-upload">
                                            <input type="file" name="picture" id="picture"
                                                   class="inputfile inputfile-3"
                                                   data-multiple-caption="{count} files selected" multiple/>
                                            <label for="picture">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                     height="17"
                                                     viewBox="0 0 20 17">
                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                </svg>
                                                <span>Change picture&hellip;</span></label>
                                            <button style="padding: 0.175rem .55rem;" type="submit"
                                                    class="btn btn-outline-success">Submit
                                            </button>

                                            <span class="help-block text-danger">{{ $errors->first('picture') }}</span>
                                        </div>
                                    </div>
                                </form>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                                        <span class="input input--hoshi">
                                        <input value="{{ $employees->nip }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">NIP</span>
                                        </label>
				                        </span>
                            @if($countbiodatas == 0)

                            @elseif($countbiodatas >= 1)
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->nik)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">NIK</span>
                                        </label>
				                        </span>
                            @endif
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->nama)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Nama</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->institusi)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Institusi</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->kota)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Kota</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->positionid)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Posisi</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->grup)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Grup</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ date('d M Y', strtotime(ucwords(strtolower($employees->tanggalbergabung)))) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tanggal Bergabung</span>
                                        </label>
				                        </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->status)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Status</span>
                                        </label>
				                        </span>
                            @if($countbiodatas == 0)

                            @elseif($countbiodatas >= 1)
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->jeniskelamin)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Jenis Kelamin</span>
                                        </label>
				                        </span>

                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->tempatlahir)) }}, {{ date('d M Y', strtotime(ucwords(strtolower($biodatas->tanggallahir)))) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tempat/Tanggal Lahir</span>
                                        </label>
				                        </span>
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->emailpribadi)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Email</span>
                                        </label>
				                        </span>
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->domisili)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Domisili</span>
                                        </label>
				                        </span>
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->kodepos)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Kode Pos</span>
                                        </label>
				                        </span>
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->agama)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Agama</span>
                                        </label>
				                        </span>
                            @endif
                            {{--<div class="form-group row">--}}
                            {{--<label for="positionid"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>--}}
                            {{--<div class="col-md-6">--}}
                            {{--<input disabled class="form-control" name="positionid"--}}
                            {{--value="{{$employees->positionid}}"--}}
                            {{--@if ($employees->positionid == 1)--}}
                            {{--value="Junior 1A"--}}
                            {{--@elseif ($employees->positionid == 2)--}}
                            {{--value="Junior 1B"--}}
                            {{--@elseif ($employees->positionid == 3)--}}
                            {{--value="Semi Senior"--}}
                            {{--@elseif ($employees->positionid == 4)--}}
                            {{--value="Semi Senior (EXP)"--}}
                            {{--@elseif ($employees->positionid == 5)--}}
                            {{--value="Senior"--}}
                            {{--@elseif ($employees->positionid == 6)--}}
                            {{--value="Senior (EXP)"--}}
                            {{--@elseif ($employees->positionid == 7)--}}
                            {{--value="Ass. Supervisor"--}}
                            {{--@elseif ($employees->positionid == 8)--}}
                            {{--value="SupervisorManager"--}}
                            {{--@elseif ($employees->positionid == 9)--}}
                            {{--value="Junior Manager"--}}
                            {{--@elseif ($employees->positionid == 10)--}}
                            {{--value="Manager"--}}
                            {{--@elseif ($employees->positionid == 11)--}}
                            {{--value="Senior Manager"--}}
                            {{--@elseif ($employees->positionid == 12)--}}
                            {{--value="Junior Partner"--}}
                            {{--@elseif ($employees->positionid == 13)--}}
                            {{--value="Client Svs. Partner"--}}
                            {{--@elseif ($employees->positionid == 14)--}}
                            {{--value="Signing Partner"--}}
                            {{--@elseif ($employees->positionid == 15)--}}
                            {{--value="Senior Partner"--}}
                            {{--@elseif ($employees->positionid == 16)--}}
                            {{--value="Entree"--}}
                            {{--@elseif ($employees->positionid == 17)--}}
                            {{--value="Junior Administrator"--}}
                            {{--@elseif ($employees->positionid == 18)--}}
                            {{--value="Administrator"--}}
                            {{--@elseif ($employees->positionid == 19)--}}
                            {{--value="Senior Administrator"--}}
                            {{--@elseif ($employees->positionid == 20)--}}
                            {{--value="Ass. Supervisor"--}}
                            {{--@elseif ($employees->positionid == 21)--}}
                            {{--value="Supervisor"--}}
                            {{--@elseif ($employees->positionid == 22)--}}
                            {{--value="Ass. Manager"--}}
                            {{--@elseif ($employees->positionid == 23)--}}
                            {{--value="Manager"--}}
                            {{--@elseif ($employees->positionid == 24)--}}
                            {{--value="General Manager"--}}
                            {{--@endif--}}
                            {{--required>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-header" style="background-color: #f4fbfb; color: #555555;">Salary History</div>
                    <hr>
                    <table class="salary-table table-bordered table table-striped table-responsive">
                        <thead>
                        <tr style="text-align: left">
                            <td>#</td>
                            <td>Change Date</td>
                            <td>Basic Salary</td>
                            <td>Position Allowance</td>
                            <td>Health Allowance</td>
                            <td>Other Allowance</td>
                            <td>Daily Allowance</td>
                            <td>OT. Transport.</td>
                            <td>OT. Meal</td>
                            <td>PTKP</td>
                            <td>Reimb.</td>
                        </tr>
                        </thead>
                        <tbody>
                        <div style="display: none">{{$no=1}}</div>
                        @if($oldsalaries == ' ')
                            <tr>
                                <td colspan="11">
                                    No data
                                </td>
                            </tr>
                            @else
                            @foreach($oldsalaries as $oldsalary)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{date("d F", strtotime($oldsalary->created_at))}}</td>
                                    <td>{{number_format($oldsalary->gajipokok, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tunjanganjabatan, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tunjangankesehatan, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tunjanganlain, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tarifthhari, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tariftransportasi, 0, '', '.')}}</td>
                                    <td>{{number_format($oldsalary->tarifmakanlembur, 0, '', '.')}}</td>
                                    <td>{{$oldsalary->statusptkp}}</td>

                                    <td>{{$oldsalary->persenbpjskesehatan}}%</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-header" style="background-color: #f4fbfb; color: #555555;">Leaves History</div>
                    <hr>
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr style="text-align: left">
                            <td>#</td>
                            <td>Date</td>
                            <td>Days</td>
                            <td>Note</td>
                            <td>Attachment</td>
                            <td>Assign</td>
                            <td>Status</td>
                            <td>Req. Date</td>
                        </tr>
                        </thead>
                        <tbody>
                        <div style="display: none">{{$no=1}}</div>
                        @if($leaves == null)
                            <tr>
                                <td colspan="8">No data</td>
                            </tr>
                        @else
                            @foreach($leaves as $leave)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{date('d M', strtotime($leave->tanggalmulaicuti))}}
                                        - {{date('d M', strtotime($leave->tanggalakhircuti))}}</td>
                                    <td>{{$leave->jumlahhari}}</td>
                                    <td>{{$leave->keterangan}}</td>
                                    <td>{{$leave->filename}}</td>
                                    <td>{{$leave->lampiranpenugasan}}</td>
                                    <td>
                                        @if($leave->statuscuti == 'approved')
                                            <span style="color: green;">Approved</span>
                                        @elseif($leave->statuscuti == 'declined')
                                            <span style="color: orangered;">Declined</span>
                                        @elseif($leave->statuscuti == 'null')
                                            <span style="color: dodgerblue;">Waiting</span>
                                        @endif
                                    </td>
                                    <td>{{date('d M', strtotime($leave->created_at))}}</td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #fbbc05">Payroll</div>

                <div class="card-body">


                            <span class="input input--hoshi">
                                        <input disabled
                                               value="{{ $employees->lembur }}"
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Lembur</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->grade)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Grade</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->norek)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Nomor Rekening</span>
                                        </label>
				                        </span>

                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->npwp)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">NPWP</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->statusptkp)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Status PTKP</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->gajipokok)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Gaji Pokok</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->persenbpjskesehatan)) }}%"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Reimbursement</span>
                                        </label>
				                        </span>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="background-color: rgba(52,51,53,0.38)">Role in Program</div>

                <div class="card-body">

                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->divisi)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Divisi</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->inchargestatus)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">In Charge Status</span>
                                        </label>
				                        </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #34a853">Allowance</div>

                <div class="card-body">

                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tunjanganjabatan)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tunjangan Jabatan</span>
                                        </label>
				                        </span>
                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tunjangankesehatan)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tunjangan Kesehatan</span>
                                        </label>
				                        </span>

                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tunjanganlain)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tunjangan Lainnya</span>
                                        </label>
				                        </span>

                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tarifthhari)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tarif TH Hari</span>
                                        </label>
				                        </span>

                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tariftransportasi)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tarif Transportasi</span>
                                        </label>
				                        </span>


                    <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($employees->tarifmakanlembur)) }}" disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Taraf Makan Lembur
                                            </span>
                                        </label>
				                        </span>
                </div>
            </div>

        </div>
    </div>
    @if($countbiodatas == 0)
    @elseif($countbiodatas >= 1)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header" style="background-color: #4285f3">Contact</div>
                    <div class="card-body">
                        <form method="POST">
                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->nohp)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">No HP</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->nomorkontakdarurat)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">No Kontak Darurat</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->namakontakdarurat)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Nama Kontak Darurat</span>
                                        </label>
                                </span>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" style="background-color: #a8377e">Insurance</div>

                    <div class="card-body">
                        <form method="POST">

                                <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->asuransi)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Asuransi / Plan</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->bpjskes)) }} / {{ ucwords(strtolower($biodatas->kodebpjskes)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">BPJS Kesehatan</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->bpjstk)) }} / {{ ucwords(strtolower($biodatas->kodebpjstk)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">BPJS Ketenagakerjaan</span>
                                        </label>
                                </span>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header" style="background-color: #a86721">Family</div>

                    <div class="card-body">
                        <form method="POST">
                            {{ csrf_field() }}
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->statussipil)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Status Sipil</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->namapasangan)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Nama Pasangan</span>
                                        </label>
                                </span>
                            <span class="input input--hoshi">
                                        <input value="{{ date('d M Y', strtotime(ucwords(strtolower($biodatas->tanggallahirpasangan)))) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Tanggal Lahir Pasangan</span>
                                        </label>
                                </span>
                            @if($jumlahanak == 0)
                            @elseif($jumlahanak >= 1)
                                <span class="input input--hoshi">
                                        <input value="{{ $jumlahanak }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Jumlah Anak</span>
                                        </label>
                                </span>
                                @foreach($childs as $child)
                                    <span class="input input--hoshi">
                                        <input value="{{ $child->namaanak }}, {{ date('d M Y', strtotime(ucwords(strtolower($child->tanggallahiranak)))) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Nama / Tanggal Lahir Anak</span>
                                        </label>
                                </span>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="background-color: #a2a3a1">Records</div>
                    <div class="card-body">
                        <form method="POST">
                                <span class="input input--hoshi">
                                        <input value="{{ $biodatas->pendidikanterakhir }}, {{ ucwords(strtolower($biodatas->universitas)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Pendidikan Terakhir, Universitas</span>
                                        </label>
                                </span>

                            <span class="input input--hoshi">
                                        <input value="{{ ucwords(strtolower($biodatas->riwayatpenyakit)) }}"
                                               disabled
                                               class="input__field input__field--hoshi" type="text" id="input-4"/>
                                        <label class="input__label input__label--hoshi input__label--hoshi-color-1"
                                               for="input-4">
                                            <span class="input__label-content input__label-content--hoshi">Riwayat Penyakit</span>
                                        </label>
                                </span>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endif


    <script>
        /*
        By Osvaldas Valutis, www.osvaldas.info
        Available for use under the MIT License
        */
        'use strict';

        (function (document, window, index) {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function (input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function (e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });

                // Firefox bug fix
                input.addEventListener('focus', function () {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function () {
                    input.classList.remove('has-focus');
                });
            });
        }(document, window, 0));
    </script>
    <script>
        function confirmdeletefile() {
            confirm("Delete file?")
        }
    </script>
    <script>
        (function () {
            // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
            if (!String.prototype.trim) {
                (function () {
                    // Make sure we trim BOM and NBSP
                    var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                    String.prototype.trim = function () {
                        return this.replace(rtrim, '');
                    };
                })();
            }

            [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
                // in case the input is already filled..
                if (inputEl.value.trim() !== '') {
                    classie.add(inputEl.parentNode, 'input--filled');
                }

                // events:
                inputEl.addEventListener('focus', onInputFocus);
                inputEl.addEventListener('blur', onInputBlur);
            });

            function onInputFocus(ev) {
                classie.add(ev.target.parentNode, 'input--filled');
            }

            function onInputBlur(ev) {
                if (ev.target.value.trim() === '') {
                    classie.remove(ev.target.parentNode, 'input--filled');
                }
            }
        })();

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>

    <script>
        $(document).ready(function () {

            $('#example').DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#exampletwo').DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },
            });
        });
    </script>
@endsection
