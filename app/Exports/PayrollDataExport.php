<?php

namespace App\Exports;

use App\MasterEmployee;
use App\TimeReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollDataExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;


    private $fileName = 'Payroll Data.xlsx';

    public function sendPara($request)
    {
        $this->request = $request;

        return $this;
    }


    public function collection()
    {

        $results = MasterEmployee::query()->select(
            'nip',
            'nama',
            'institusi',
            'kota',
            'tanggalbergabung',
            'status',
            'positionid',
            'lembur',
            'grade',
            'grup',
            'norek',
            'npwp',
            'statusptkp',
            'gajipokok',
            'tunjanganjabatan',
            'tunjangankesehatan',
            'tunjanganlain',
            'tarifthhari',
            'tariftransportasi',
            'tarifmakanlembur',
            'persenbpjskesehatan'
        );
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
        $collection = $results->get();

        return $collection;

    }


    public
    function headings(): array
    {
        return [
            'NIP',
            'Name',
            'Institution',
            'City',
            'Join Date',
            'Status',
            'Position',
            'Overtime',
            'Grade',
            'Group',
            'Bank Account',
            'NPWP',
            'PTKP Status',
            'Basic Salary',
            'Position Allowance',
            'Health Allowance',
            'Other Allowance',
            'Daily Allowance',
            'Transportation',
            'Food Overtime',
            'Health BPJS Percentage',
        ];
    }
}
