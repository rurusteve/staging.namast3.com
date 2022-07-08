<?php

namespace App\Exports;


use App\TimeReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GreenFormulaExport implements FromView, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;


//    private $fileName = 'timereport.xlsx';

    public function sendPara($request)
    {
        $this->request = $request;

        return $this;
    }


    public function view(): View
    {
        
        $results =  DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip');

        if ($this->request->has('institusi')) {
            $results->where('institusi', 'like', $this->request->institusi);
        }
        if ($this->request->has('kota')) {
            $results->where('kota', 'like', $this->request->kota);
        }
        if ($this->request->has('status')) {
            $results->where('status', 'like', $this->request->status);
        }
        if ($this->request->has('positionid')) {
            $results->where('positionid', 'like', $this->request->positionid);
        }
        if ($this->request->has('grade')) {
            $results->where('grade', 'like', $this->request->grade);
        }
        if ($this->request->has('group')) {
            $results->where('grup', 'like', $this->request->group);
        }
        if ($this->request->has('periode')) {
                $results->where('payrollhistory.periode', 'like', $this->request->periode);
                $results->where('payrollinput.periode', 'like', $this->request->periode);
        }
        
        $employeepayrolls = $results
                 ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*', 
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))
                ->groupBy('payrollhistory.nip')
                ->get();

        return view('download.greenformula', [
            'employeepayrolls' => $employeepayrolls
            ]);

    }


    public
    function headings(): array
    {
        return [
          'EMPLOYEE NAME',
          'NIP',
          'JOINING DATE',
          'START M.',
          'END M.',
          'TOTAL M.',
          'SALARY (YEARLY)',
          'PPH21 ALLOWANCE',
          'ALLOWANCE (YEARLY)',
          'HONORARIUM (YEARLY)',
          'ASTEK (YEARLY)',
          'TOTAL ROUTINE INCOME',
          'HOLIDAY ALLOWANCE & BONUS (YEARLY)',
          'GROSS INCOME',
          'BIJAB AT. PENG. RUTIN',
          'BIJAB AT. PENG. NON-RUTIN',
          'ASTEK 2% (YEARLY)',
          'DEDUCTIONS',
          'TOTAL NET INCOME',
          'PTKP',
          'PKP',
          'ROUND',
          'LAPIS',
          'INCOME TAX',
          '20% HIGHER TAX',
          'INCOME TAX',
          'BEEN PAID',
          'LESS PAID',
        ];
    }
}
