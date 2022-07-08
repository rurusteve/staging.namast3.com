<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeReportHead extends Model
{
    public function details()
    {
        return $this->hasMany(TimeReport::class, 'timereportheadid', 'id');
    }

    public function delete()
            {
                // delete all associated photos
                $this->details()->delete();

                // delete the user
                return parent::delete();
            }

    protected $hidden = ['created_at', 'updated_at'];
    public $table = 'mastertimereporthead';
    protected $guarded = [];
    protected $fillable = [
        'report_date',
        'total_hour',
        'overtimemeal',
        'overtimetransportation',
        'created_at',
        'updated_at',
        'user_id'
    ];

}
