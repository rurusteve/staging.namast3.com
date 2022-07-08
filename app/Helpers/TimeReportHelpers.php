<?php

namespace App;

function isReportLocked(string $nip, int $period)
{
    $status = Statuses::where('nip', $nip)->where('period', $period)->first();
    return (!empty($status->is_report_locked) ? $status->is_report_locked : 0);
}
