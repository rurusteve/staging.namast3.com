<?php

namespace App\Imports;

use App\MasterClient;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportClientData implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            User::create([
                'clientname' => $row['clientname'],
                'engagementperiod' => Carbon::parse($row['engagementperiod']),
                'clientcode' => $row['clientcode'],
                'location' => $row['location'],
                'institusi' => $row['institution'],
                'branch' => $row['branch'],
                'engagementtype' => $row['engagementtype'],
                'keterangan' => $row['others'],
                'fee' => $row['fee'],
            ]);

        }
    }

}

