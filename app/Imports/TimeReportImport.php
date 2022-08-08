<?php

namespace App\Imports;

use Carbon\Carbon;
use App\MasterClient;
use App\TimeReport;
use App\TimeReportHead;
use App\MasterEmployee;
use App\Statuses;
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

class TimeReportImport implements ToCollection, WithHeadingRow
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

    public function updateOrCreateTimeReportHead($row)
    {
        if (is_string($row['date'])) {
            $date = Carbon::parse($row['date']);
        }
        if (is_integer($row['date'])) {
            $date = Date::excelToDateTimeObject($row['date']);
        }
        
        if($this->user->lembur === 'T'){
            $duration['overtime'] = 0;
            $row['type'] = 'REGULAR_HOUR';
        }

        $head = TimeReportHead::where('report_date', '=', $date)
            ->where('user_nip', '=', Auth::user()->nip)->first();
        $clients = MasterClient::where('id', '=', $row['client_id'])->first();
        $clientname = $clients->clientname;
        $employeedata = MasterEmployee::where('nip', '=', Auth::user()->nip)->first();
        $day_of_week = date('l', $date->format('d'));
        $day = date('N', strtotime($day_of_week));


        $thedate = DB::table('mastertimereporthead')->where('report_date', '=', $date)
            ->where('user_nip', '=', Auth::user()->nip)->first();
        $getdatedata = DB::table('mastertimereports')->where('date', '=', $date)
            ->where('nip', '=', Auth::user()->nip)->first();
        $getovertimesdata = DB::table('mastertimereports')->where('date', '=', $date)
            ->where('nip', '=', Auth::user()->nip)->sum('overtimes');

        
        $duration = getDuration($row['start_time'], $row['finish_time'], $row['type']);

        if ($getdatedata === null) {
            if ($duration['overtime'] == 0 || $duration['overtime'] == null) {
                $ineffectiverules = 0;
            } else {
                if ($day >= 6 && $duration['overtime'] >= 0) {
                    $ineffectiverules = 0.75;
                } elseif ($day < 6 && $duration['overtime'] >= 0) {
                    $ineffectiverules = 0.50;
                }
            }
            $overtime = $duration['overtime'];
            $regularaccumulation = $duration['regular'];
            $overtimeaccumulation = $overtime;
            $checkovertime = $overtimeaccumulation;
            $totalhours = $duration['regular'] + $overtime - $ineffectiverules;

            if ($day < 6) {
                if ($totalhours >= 10.5 && $totalhours < 11.5) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = 0;
                } elseif ($totalhours >= 11.5) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($totalhours < 10.5) {
                    $overtimemeal = 0;
                    $overtimetransportation = 0;
                }
            } elseif ($day > 5) {
                if ($checkovertime >= 2.25 && $checkovertime < 12.25) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = 0;
                } elseif ($checkovertime >= 12.25) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($checkovertime < 2.25) {
                    $overtimemeal = 0;
                    $overtimetransportation = 0;
                }
            }
        } else {
            $seeovertime = DB::table('mastertimereports')->where('date', '=', $date)
                ->where('nip', '=', Auth::user()->nip)->sum('overtimes');
            $getineffectiverules = DB::table('mastertimereports')->where('date', '=', $date)
                ->where('nip', '=', Auth::user()->nip)->orderBy('ineffectiverules')->get();

            if ($duration['overtime'] == null) {
                $overtime = 0;
                $ineffectiverules = 0;
            } else {
                if ($seeovertime >= 2) {
                    if ($day >= 6 && $row['overtimess'] >= 0) {
                        $ineffectiverules = 0.75;
                    } elseif ($day < 6 && $duration['overtime'] >= 0) {
                        $ineffectiverules = 0.50;
                    }
                } else {
                    if ($day >= 6 && $duration['overtime'] >= 0) {
                        $ineffectiverules = 0;
                    } elseif ($day < 6 && $duration['overtime'] >= 0) {
                        $ineffectiverules = 0;
                    }
                }
            }
            $overtime = $duration['overtime'];
            $sumregular = DB::table('mastertimereports')->where('date', '=', $date)
                ->where('nip', '=', Auth::user()->nip)->sum('normalhours');
            $regularaccumulation = $duration['regular'] + $sumregular;
            $sumoverbudget = DB::table('mastertimereports')->where('date', '=', $date)
                ->where('nip', '=', Auth::user()->nip)->sum('ineffectivehours');
            $overbudgetaccumulation = $sumoverbudget;

            if ($getdatedata == null) {
                $overtimeaccumulation = $overtime - $ineffectiverules;
            } else {
                $overtimeaccumulation = $overtime + $getovertimesdata - $ineffectiverules;
            }
            if ($thedate == null) {
                $totalhours = $duration['regular'] + $overtime - $ineffectiverules;
            } else {
                $totalhours = $thedate->total_hour + $duration['regular'] + $overtime;
            }

            if ($day < 6) {
                if ($overtimeaccumulation >= 2.5 && $overtimeaccumulation < 3.5) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = 0;
                } elseif ($overtimeaccumulation >= 3.5) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($overtimeaccumulation < 2.5) {
                    $overtimemeal = 0;
                    $overtimetransportation = 0;
                }
            } elseif ($day > 5) {
                if ($overtimeaccumulation >= 2.25 && $overtimeaccumulation < 12.25) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = 0;
                } elseif ($overtimeaccumulation >= 12.25) {
                    $overtimemeal = $employeedata->tarifmakanlembur;
                    $overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($overtimeaccumulation < 12.25) {
                    $overtimemeal = 0;
                    $overtimetransportation = 0;
                }
            }
        }

        if ($head == null) {
            $timereportheads = new TimeReportHead();
            $timereportheads->user_nip = Auth::user()->nip;
            $timereportheads->report_date = $date;
            $timereportheads->total_hour = $totalhours;
            $timereportheads->overtimemeal = $overtimemeal;
            $timereportheads->overtimetransportation = $overtimetransportation;
            $timereportheads->save();

            $head = $timereportheads;
        } else {
            $id = $head->id;
            TimeReportHead::find($id)->update([
                'total_hour' => $totalhours + $duration['regular'] + $duration['overtime'],
                'overtimemeal' => $overtimemeal,
                'overtimetransportation' => $overtimetransportation
            ]);
        }

        return $head;
    }

    public function getDailyTotal($rows, $date)
    {
        $total_hours = 0;
        foreach ($rows as $row) {
            $row_date = Date::excelToDateTimeObject($row['date']);
            $hours = $rows['normal_hours'];
            if ($row_date = $date) {
                $total_hours = $total_hours + $hours;
            }
        }
        return $total_hours;
    }

    public function collection(Collection $rows)
    {
        $start_period = getStartPeriod($this->period);
        $end_period = getEndPeriod($this->period);
        $error_count = 0;
        $row_count = 0;

        try {
            foreach ($rows as $row) {
                if($this->user->lembur === 'T'){
                    $duration['overtime'] = 0;
                    $row['type'] = 'REGULAR_HOUR';
                }
    
                $duration = getDuration($row['start_time'], $row['finish_time'], $row['type']);
    
                if ($row['nip'] == Auth::user()->nip) {
                    if (is_string($row['date'])) {
                        $date = Carbon::parse($row['date']);
                    }
                    if (is_integer($row['date'])) {
                        $date = Date::excelToDateTimeObject($row['date']);
                    }
                //     $summary = TimeReportHead::where('report_date', '=', $date)
                // ->where('user_nip', '=', Auth::user()->nip)->first();
                    $summary = $this->updateOrCreateTimeReportHead($row);
                    
                    $row_count += 1;
                    if (is_string($row['date'])) {
                        $date = Carbon::parse($row['date']);
                        $date->format('Y-m-d');
                    }
                    if (is_integer($row['date'])) {
                        $date = Date::excelToDateTimeObject($row['date']);
                    }

                    $seeovertime = DB::table('mastertimereports')->where('date', '=', $date)
                    ->where('nip', '=', Auth::user()->nip)->sum('overtimes');
                    
                    $day_of_week = date('l', $date->format('d'));
                    $day = date('N', strtotime($day_of_week));
                    
                    if ($duration['overtime'] == null) {
                        $overtime = 0;
                        $ineffective = 0;
                    } else {
                        if ($seeovertime >= 2) {
                            if ($day >= 6 && $row['overtimess'] >= 0) {
                                $ineffective = 0.75;
                            } elseif ($day < 6 && $duration['overtime'] >= 0) {
                                $ineffective = 0.50;
                            }
                        } else {
                            if ($day >= 6 && $duration['overtime'] >= 0) {
                                $ineffective = 0;
                            } elseif ($day < 6 && $duration['overtime'] >= 0) {
                                $ineffective = 0;
                            }
                        }
                    }
                    
                    $row_data = [
                        'timereportheadid' => $summary->id,
                        'nip' => $row['nip'],
                        'date' => $date,
                        'day' => $date->format('l'),
                        'week' => Carbon::parse($date)->weekNumberInMonth,
                        'task' => strstr($row['task'], '.', true),
                        'clientid' => $row['client_id'],
                        'starttime' => Carbon::parse($row['start_time']),
                        'finishtime' => Carbon::parse($row['finish_time']),
                        'normalhours' => $duration['regular'] ? $duration['regular'] : 0,
                        'overtimes' => $overtime ? $overtime : 0,
                        'ineffectiverules' => $ineffective ? $ineffective : 0,
                        'description' => $row['description'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
    
                    $total_inputted = TimeReport::where('date', $date)
                        ->where('nip', Auth::user()->nip)
                        ->selectRaw('sum(normalhours) as total_hours, date')
                        ->get();
                        
                    $status = Statuses::where('nip', $row['nip'])->where('period', $date->format('m'))->first();
                    
                    if (($total_inputted->sum->total_hours + $duration['regular'] )>= 8) {
                        $error_count += 1;
                        $this->error[$error_count] = $row_count + 1;
                    } else {
                        if(isset($status)){
                            if($status->is_report_locked){
                                $error_count += 1;
                                $this->error[$error_count] = $row_count + 1;
                            }else{
                                $summary->details()->create($row_data);
                            }
                        }else{
                    
                            // TimeReportHead::whereBetween('report_date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
                            // ->where('user_nip', Auth::user()->nip)->delete();
                            $summary->details()->create($row_data);
                        }
        
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
