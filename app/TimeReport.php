<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Throw_;

class TimeReport extends Model
{
    public function summary()
    {
        return $this->belongsTo(TimeReportHead::class, 'id', 'timereportheadid');
    }

    public function task()
    {
        return $this->belongsTo(MasterTask::class, 'id', 'task');
    }

    protected $hidden = ['created_at', 'updated_at'];
    public $table = 'mastertimereports';
    protected $guarded = [];
    protected $appends = ['is_partially_approved'];
    protected $fillable = [
        'nip',
        'date',
        'day',
        'week',
        'clientid',
        'task',
        'normalhours',
        'starttask',
        'endtask',
        'overtimes',
        'starttime',
        'finishtime',
        'ineffectivehours',
        'ineffectiverules',
        'activities',
        'period' ,
        'description' ,
        'overtimemeal',
        'overtimetransportation',
        'is_business_trip',
        'approved_by_incharge',
        'approved_by_hr',
        'approved_by_partner'
    ];

    public function getIsPartiallyApprovedAttribute($value)
    {
        return "Partially";
    }

    public function setIsPartiallyApprovedAttribute($value)
    {
        $this->attributes['is_partially_approved'] = !($this->attributes['approved_by_incharge'] || $this->attributes['approved_by_hr'] || $this->attributes['approved_by_partner']);
    }

    public function approveByPeriod($period, $nip)
    {
        $data = MasterEmployee::where('nip', Auth::user()->nip)->first();

        $start_period = getStartPeriod($period);
        $end_period = getEndPeriod(($period));

        $normalhours = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
        ->where('nip', $nip)->sum('normalhours');
        $timereports = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
        ->where('nip', $nip)->get();

        switch(Auth::user()->division) {
            case 'PARTNER':
                foreach ($timereports as $timereport){
                    $timereport->approved_by_partner = true;
                    $timereport->save();
                }
                break;
            case 'HRD':
                foreach ($timereports as $timereport){
                    $timereport->approved_by_hr = true;
                    $timereport->save();
                }
                break;
            default:
                if($data->incharge){
                    foreach ($timereports as $timereport){
                        $timereport->approved_by_hr = true;
                        $timereport->save();
                    }
                }
        }

        return $timereports;
    }

    public function approveAllByPeriod(int $period)
    {
        $start_period = getStartPeriod($period);
        $end_period = getEndPeriod(($period));

        $timereports = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])->get();

        switch(Auth::user()->division) {
            case 'PARTNER':
                foreach ($timereports as $timereport){
                    $timereport->approved_by_partner = true;
                    $timereport->save();
                }
                break;
            case 'HRD':
                foreach ($timereports as $timereport){
                    $timereport->approved_by_hr = true;
                    $timereport->save();
                }
                break;
            default:
                throw new Exception('Not allowed to approve');
        }

        return $timereports;
    }

    public function approvedByIncharge ()
    {
        $this->approved_by_incharge = true;
        $this->save();
        return $this;
    }

    public function approvedByHR ()
    {
        $this->approved_by_hr = true;
        $this->save();
        return $this;
    }

    public function approvedByPartner ()
    {
        $this->approved_by_partner = true;
        $this->save();
        return $this;
    }
}
