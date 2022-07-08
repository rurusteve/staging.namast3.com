<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    public $table = 'statuses';

    public function setAsLocked()
    {
        $this->is_report_locked = TRUE;
        $this->save();
        return $this;
    }

    public function setAsUnlocked()
    {
        $this->is_report_locked = FALSE;
        $this->save();
        return $this;
    }

    public function markAsCalculated()
    {
        $this->is_payroll_calculated = TRUE;
        $this->save();
        return $this;
    }

    public function markAsUnalculated()
    {
        $this->is_payroll_calculated = FALSE;
        $this->save();
        return $this;
    }


    public function markAsRevised()
    {
        $this->is_revised = TRUE;
        $this->save();
        return $this;
    }

    public function markAsUnrevised()
    {
        $this->is_revised = FALSE;
        $this->save();
        return $this;
    }
}
