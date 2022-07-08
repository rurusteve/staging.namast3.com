<?php

use App\EmployeePosition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = EmployeePosition::truncate();
        $data = [
            ['name' => 'Junior 1A'],
            ['name' => 'Junior 1B'],
            ['name' => 'Semi Senior'],
            ['name' => 'Semi Senior (EXP)'],
            ['name' => 'Senior'],
            ['name' => 'Senior (EXP)'],
            ['name' => 'Ass. Supervisor'],
            ['name' => 'Supervisor'],
            ['name' => 'Junior Manager'],
            ['name' => 'Manager'],
            ['name' => 'Senior Manager'],
            ['name' => 'Junior Partner'],
            ['name' => 'Manager 4'],
            ['name' => 'Client Svs. Partner'],
            ['name' => 'Signing Partner'],
            ['name' => 'Senior Partner'],
            ['name' => 'Administration'],
            ['name' => 'Entree'],
            ['name' => 'Junior Administrator'],
            ['name' => 'Administrator'],
            ['name' => 'Senior Administrator'],
            ['name' => 'Ass. Supervisor'],
            ['name' => 'Supervisor'],
            ['name' => 'Ass. Manager'],
            ['name' => 'General Manager'],

        ];
        DB::table('employee_positions')->insert($data);
    }
}
