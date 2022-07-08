<?php

namespace App\Imports;

use Carbon\Carbon;
use App\MasterClient;
use App\TimeReport;
use App\TimeReportHead;
use App\MasterEmployee;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use function App\getDuration;
use function App\getEndPeriod;
use function App\getStartPeriod;

class OverbudgetImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $period;

    public $error;

    public function __construct(int $period = null, array $error = [])
    {
        $this->period = $period;
        $this->error = $error;
        $this->user = MasterEmployee::where('nip', Auth::user()->nip)->first();
    }

    public function returnError()
    {
        return ($this->error);
    }

    public function collection(Collection $rows)
    {
        $error_count = 0;
        $row_count = 0;

        foreach ($rows as $row) {
            $timereportsdetail = TimeReport::find($row['id']);
            $previousOverbudget = $timereportsdetail->overbudget_hours;
            $timereportsdetail->editineffective = $row['overbudget_hours'];
            $timereportsdetail->save();

            $timereportshead = TimeReportHead::find($timereportsdetail->timereportheadid);
            $timereportshead->total_hour = $row['overbudget_hours'] - $timereportsdetail->overbudget_hours;
            $timereportshead->save();
        }
    }
}
