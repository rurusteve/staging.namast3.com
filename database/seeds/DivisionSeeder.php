<?php

use App\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = Division::truncate();
        $data = [
            [
                'id' => 1,
                'name' => 'Partners',
                'code' => 'PRT',
            ],
            [
                'id' => 2,
                'name' => 'Admins',
                'code' => 'ADM',
            ],
            [
                'id' => 3,
                'name' => 'Taxations',
                'code' => 'TAX',
            ],
            [
                'id' => 4,
                'name' => 'Accountings',
                'code' => 'ACC',
            ],
            [
                'id' => 5,
                'name' => 'Auditors',
                'code' => 'AUD',
            ],

        ];
        DB::table('divisions')->insert($data);
    }
}
