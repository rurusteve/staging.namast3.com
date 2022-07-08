<?php

namespace App;

use Carbon\Carbon;

function getPeriod(Carbon $date)
{
    if ($date->format('d') <= 24) {
        return (int) $date->format('m');
    } else {
        return (int) $date->format('m') + 1;
    }
}

function getStartPeriod(int $period)
{
    $now = Carbon::now();
    $start_date = 25;
    $start_month    = ($period === 1) ? 12 : $period - 1;
    $start_year     = ($period === 1) ? (int)$now->format('Y') - 1 : $now->year;

    $start_period = Carbon::createFromFormat('d/m/Y', $start_date . '/' . $start_month . '/' . $start_year);

    return $start_period;
}


function getEndPeriod(int $period)
{
    $now = Carbon::now();
    $start_date = 25;
    $end_date = $start_date - 1;
    $end_month      = ($period === 12) ? 1 : $period;
    $end_year       = ($period === 12) ? (int)$now->format('Y') + 1 : $now->year;

    $end_period = Carbon::createFromFormat('d/m/Y', $end_date . '/' . $end_month . '/' . $end_year);

    return $end_period;
}

function toHour(int $time)
{
    $time = $time / 60;

    return $time;
}

function getDuration($startTime, $finishTime, $type)
{
    
    $duration = round(((Carbon::parse($finishTime)->diffInMinutes(Carbon::parse($startTime))) / 60), 2);
    $decrease = 0;
    if(Carbon::parse($startTime)->lt(Carbon::parse('13:00')) && Carbon::parse($finishTime)->gt(Carbon::parse('12:00'))){
        if(Carbon::parse($startTime)->gt(Carbon::parse('12:00'))){
            $break = round(Carbon::parse($startTime)->diffInMinutes(Carbon::parse('13:00'))/60,2);
            if($decrease == 0){
                $decrease = $decrease + $break;        
            }
        }
        if(Carbon::parse($finishTime)->lt(Carbon::parse('13:00'))){
            $break = round(Carbon::parse($finishTime)->diffInMinutes(Carbon::parse('12:00'))/60,2);
            if($decrease == 0){
                $decrease = $decrease + $break;        
            }
        }
        if($decrease == 0){
            $decrease = $decrease + 1;        
        }
    }

    if(Carbon::parse($finishTime)->lt(Carbon::parse('13:01')) && Carbon::parse($finishTime)->gt(Carbon::parse('12:00')) ){
        $break = round(Carbon::parse($finishTime)->diffInMinutes(Carbon::parse('12:00'))/60,2);
        if($decrease == 0){
            $decrease = $decrease + $break;        
        }
    }

    if(Carbon::parse($startTime)->gt(Carbon::parse('11:59')) && !Carbon::parse($startTime)->gt(Carbon::parse('13:00')) ){
        $break = round(Carbon::parse($startTime)->diffInMinutes(Carbon::parse('13:00'))/60,2);
        if($decrease == 0){
            $decrease = $decrease + $break;        
        }
    }
    
    $duration = $duration - $decrease;

    if(Carbon::parse($finishTime)->lt(Carbon::parse($startTime))){
        $duration = 0;
    }

    switch ($type) {
        case 'REGULAR_HOUR':
            $overtime = 0;
            $regular = $duration;
            break;
        case 'OVERTIME_HOUR':
            $overtime = $duration;
            $regular = 0;
            break;

        default:
            $overtime = 0;
            $regular = 0;
            break;
    }

    $data = [
        'overtime'  => $overtime,
        'regular'   => $regular
    ];

    return $data;
}