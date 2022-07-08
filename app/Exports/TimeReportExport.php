<?php

namespace App\Exports;

use App\MasterEmployee;
use App\MasterTask;
use App\TimeReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

use function App\getEndPeriod;
use function App\getStartPeriod;

class TimeReportExport implements FromCollection, WithHeadings
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


    public function collection()
    {
        $thisyear = Carbon::now()->year;
        $week = $this->request->week;
        $month = $this->request->month;
        $startdate = $this->request->startdate;
        $enddate = $this->request->enddate;

        $employee = MasterEmployee::where('nip', $this->request->nip)->first();

        if ($this->request->has('nip')) {

            $results = TimeReport::query()
                ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                //            ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip');
                ->select('mastertimereports.id', 'mastertimereports.date', 'mastertimereports.normalhours',
                    DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'), 'mastertimereports.editineffective',
                    'mastertimereports.overtimemeal',
                    'mastertimereports.overtimetransportation',
                    'mastertimereports.period', 'mastertimereports.description', 'mastertasks.taskname',
                    'masterclients.clientname', 'masterclients.clientcode');

        }else{
            $results = TimeReport::query()
                ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                //            ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip');
                ->select('masteremployee.nama', 'masteremployee.institusi',
                    'masteremployee.kota', 'masteremployee.positionid', 'masteremployee.grup',
                    'mastertimereports.date', 'mastertimereports.normalhours',
                    DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'), 'mastertimereports.editineffective',
                    'mastertimereports.overtimemeal',
                    'mastertimereports.overtimetransportation',
                    'mastertimereports.period', 'mastertimereports.description', 'mastertasks.taskname',
                    'masterclients.clientname', 'masterclients.clientcode');
        }
        if ($this->request->has('nip')) {
            $results->where('mastertimereports.nip', '=', $this->request->nip);
        }
        if ($this->request->has('week')) {
            $results->where('mastertimereports.week', '=', $this->request->week);
        }
        if ($this->request->has('period')) {
            $start = getStartPeriod($this->request->period);
            $finish = getEndPeriod($this->request->period);
            $results->whereBetween('date', [$start, $finish]);
        }
        if ($this->request->has('startdate') && $this->request->has('enddate')) {
            $results->whereBetween('date', [$startdate, $enddate] );
        }
        if ($this->request->has('institusi')) {
            $results->where('masteremployee.institusi', 'like', $this->request->institusi);
        }
        if ($this->request->has('kota')) {
            $results->where('masteremployee.kota', 'like', $this->request->kota);
        }
        if ($this->request->has('status')) {
            $results->where('masteremployee.status', 'like', $this->request->status);
        }
        if ($this->request->has('positionid')) {
            $results->where('masteremployee.positionid', 'like', $this->request->positionid);
        }
        if ($this->request->has('grade')) {
            $results->where('masteremployee.grade', 'like', $this->request->grade);
        }
        if ($this->request->has('group')) {
            $results->where('grup', 'like', $this->request->group);
        }
        $results = $results->orderBy('mastertimereports.date', 'asc');
        $results = $results->get()->toArray();
        foreach ($results as $result)
        {
            $result['nip'] = $employee->nip;
            $result['name'] = $employee->nama;
            $result['institution'] = $employee->institusi;
            $result['city'] = $employee->kota;
            $result['position'] = $employee->positionid;
            $result['group'] = $employee->grup;
        }
        $collection = collect($results);
        return $collection;
    }

//if(!empty ( $week ) && !empty ( $month )){
//return TimeReport::query()
//->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
//->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip')
//->where('mastertimereports.week', '=', $week)
//->whereMonth('mastertimereports.date', $month)
//
//}elseif(!empty ( $week )){
//            return TimeReport::query()
//                ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
//                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//                ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip')
//                ->where('mastertimereports.week', '=', $week)
//                ->orderBy('mastertimereports.created_at', 'desc')
//                ->groupBy('mastertimereports.nip');
//        }elseif(!empty ( $month )){
//            return TimeReport::query()
//                ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
//                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//                ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip')
//                ->whereMonth('date', '=', $month)
//                ->orderBy('mastertimereports.created_at', 'desc')
//                ->groupBy('mastertimereports.nip');
//        }elseif(!empty ( $startdate ) && !empty ( $enddate )){
//            return TimeReport::query()
//                ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
//                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//                ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip')
//                ->whereBetween('date', [$startdate, $enddate] )
//                ->orderBy('mastertimereports.created_at', 'desc')
//                ->groupBy('mastertimereports.nip');
//        }else{
//    return TimeReport::query()
//        ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
//        ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//        ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
//            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, SUM(mastertimereports.overtimemeal) as overtimemeal
//            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
//            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
//            ,masteremployee.nip as nip')
//        ->orderBy('mastertimereports.created_at', 'desc')
//        ->groupBy('mastertimereports.nip');
//}
//    public function view(): View
//    {
//

//
//        return view('download.timereport', [
//            'timereports' => $timereports
//        ]);
//    }

//    public function query()
//    {
//        $timereports = TimeReport::query()
//            ->select('nip');
//        return $timereports;
//    }
    public function headings(): array
    {

        if(isset($this->request))
        {

            if ($this->request->has('nip')) {
                return [
                    'ID',
                    'Date',
                    'Regular Hour(s)',
                    'Overtime Hour(s)',
                    'Overbudget Hour(s)',
                    'Overtime Meal',
                    'Overtime Transportation',
                    'Periode',
                    'Description',
                    'Task',
                    'Client',
                    'Client Code'
                ];
            }else{
                return [
                    'NIP',
                    'Name',
                    'Institution',
                    'City',
                    'Position',
                    'Group',
                    'Date',
                    'Regular Hour(s)',
                    'Overtime Hour(s)',
                    'Overbudget Hour(s)',
                    'Overtime Meal',
                    'Overtime Transportation',
                    'Periode',
                    'Description',
                    'Task',
                    'Client',
                    'Client Code'
                ];
            }
        }
    }


}
