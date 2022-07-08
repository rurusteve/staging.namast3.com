<?php

namespace App\Imports;

use App\MasterClient;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            User::create([
                'nip' => $row['nip'],
                'name' => $row['name'], 
                'email' => $row['email'], 
                'logintype'=> $row['logintype'], 
                'admin' => $row['admin'], 
                'password' => Hash::make($row['password']),
                'contact' => $row['contact'], 
                'division' => $row['division'],
            ]);

        }
    }

}

