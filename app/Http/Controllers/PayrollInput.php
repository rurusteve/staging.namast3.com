<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollInput extends Controller
{
    public function create(){
        return view('insertemployee');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function input(Request $request)
    {
        $employee = new MasterEmployee();

        $this->validate($request,[
            'nip' => 'required',
            'nama' => 'required',
            'institusi' => 'required',
            'kota' => 'required',
            'tanggalbergabung' => 'required',
            'status' => 'required',
            'positionid' => 'required',
            'lembur' => 'required',
            'grade' => 'required',
            'grup' => 'required',
            'norek' => 'required',
            'npwp' => 'required',
            'statusptkp' => 'required',
            'gajipokok' => 'required',
            'tunjanganjabatan' => 'required',
            'tunjangankesehatan' => 'required',
            'tunjanganlain' => 'required',
            'tarifthhari' => 'required',
            'tariftransportasi' => 'required',
            'tarifmakanlembur' => 'required',
            'statuspernikahan' => 'required',
            'jeniskelamin' => 'required',
            'jumlahanak' => 'required'
        ]);

        $employee->nip = $request->nip;
        $employee->nama = $request->nama;
        $employee->institusi = $request->institusi;
        $employee->kota = $request->kota;
        $employee->tanggalbergabung = Carbon::parse($request->tanggalbergabung);
        $employee->status = $request->status;
        $employee->lembur = $request->lembur;
        $employee->grade = $request->grade;
        $employee->grup = $request->grup;
        $employee->norek = $request->norek;
        $employee->npwp = $request->npwp;
        $employee->statusptkp = $request->statusptkp;
        $employee->gajipokok = $request->gajipokok;
        $employee->tunjanganjabatan = $request->tunjanganjabatan;
        $employee->tunjangankesehatan = $request->tunjangankesehatan;
        $employee->tunjanganlain = $request->tunjanganlain;
        $employee->tarifthhari = $request->tarifthhari;
        $employee->tariftransportasi = $request->tariftransportasi;
        $employee->tarifmakanlembur = $request->tarifmakanlembur;
        $employee->statuspernikahan = $request->statuspernikahan;
        $employee->jeniskelamin = $request->jeniskelamin;
        $employee->jumlahanak = $request->jumlahanak;
        $employee->positionid = $request -> positionid;
        $employee->save();
        return view ('/payrollhome');
    }
}
