@extends('layouts.app')
@section('title', 'Announcement')

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #fafafa !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title mt-0"> News</h4>
                        {{--<p class="card-category"> Here is a subtitle for this table</p>--}}
                    </div>
                    <div class="card-body">
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] December 6, 2019</b></h4>
                            <h4>Mass Payroll</h4>
                            <hr>
                            <p>Proses gaji seluruh karyawan dalam satu klik.</p>
                        </div>
                        
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] July 11, 2019</b></h4>
                            <h4>Single Device</h4>
                            <hr>
                            <p>Untuk meningkatkan sekuritas akun anda, akun hanya bisa digunakan dalam 1 perangkat saja. Akun anda akan otomatis logout apabila digunakan pada perangkat lain.</p>
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] July 9, 2019</b></h4>
                            <h4>Notifikasi Email Cuti kepada Incharge</h4>
                            <hr>
                            <p>Selain HRD, salah satu incharge dalam grup akan mendapatkan notifikasi mengenai cuti yang diajukan oleh rekan se-grup dalam bentuk email.
                            </p>
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] July 9, 2019</b></h4>
                            <h4>Bug Halaman Edit Client pada Sekretaris</h4>
                            <hr>
                            <p>Engagement type saat diedit kini otomatis mengikuti engagement type sebelumnya, tidak direset lagi.</p>
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] July 9, 2019</b></h4>
                            <h4>Bug Halaman Lampiran Cuti pada Manager/Incharge</h4>
                            <hr>
                            <p>Kesalahan alamat saat mengunduh file lampiran cuti telah diperbaiki</p>
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] July 8, 2019</b></h4>
                            <h4>Rentang Waktu Halaman Slip Gaji</h4>
                            <hr>
                            <p>Rentang waktu yang diberikan untuk melihat Slip Gaji dibuat lebih cepat menjadi 2 menit.</p>
                            {{--<p>The input system of <b>Regular Hour(s)</b> cannot be less or more than 8 in a day. If professional inputted less then 8, there will be an alert on the professional's dashboard. If </p>--}}
                            {{--<hr>--}}
                            {{--<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>--}}
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] June 29, 2019</b></h4>
                            <h4>Regular Hour(s), Validasi Input Time Report</h4>
                            <hr>
                            <p>Sistem input Regular Hour(s) pada Time Report tidak bisa lebih atau kurang dari 8 jam dalam satu hari. Apabila akumulasi Regular Hour(s) dalam satu hari kurang dari 8 jam akan muncul pemberitahuan di menu Time Report pada dasbor yang bersangkutan. Sebaliknya, apabila lebih dari 8 jam saat penginputan, sistem akan menutup akses untuk mengupload Time Report untuk tanggal tersebut.
                            </p>
                            {{--<p>The input system of <b>Regular Hour(s)</b> cannot be less or more than 8 in a day. If professional inputted less then 8, there will be an alert on the professional's dashboard. If </p>--}}
                            {{--<hr>--}}
                            {{--<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>--}}
                        </div>
                        <div style="border:1px solid grey;" class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading"><b>[System] June 29, 2019</b></h4>
                            <h4>HR Team Management</h4>
                            <hr>
                            <p>Penambahan fitur baru untuk menambahkan atau memindahkan anggota tim untuk professional</p>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
