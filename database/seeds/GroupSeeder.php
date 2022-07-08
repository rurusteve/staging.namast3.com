<?php

use App\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::truncate();
        $data = [
            [
                'id' => 1,
                'division_id' => 1,
                'name' => 'Partner',
                'code' => 'PRT',
            ],
            [
                'id' => 2,
                'division_id' => 2,
                'name' => 'Human Resource',
                'code' => 'HRD',
            ],
            [
                'id' => 3,
                'division_id' => 2,
                'name' => 'Finance',
                'code' => 'FIN',
            ],
            [
                'id' => 4,
                'division_id' => 2,
                'name' => 'Information Technology',
                'code' => 'IT',
            ],
            [
                'id' => 5,
                'division_id' => 2,
                'name' => 'General Affair',
                'code' => 'GA',
            ],
            [
                'id' => 6,
                'division_id' => 2,
                'name' => 'Secretary',
                'code' => 'SCR',
            ],
            [
                'id' => 7,
                'division_id' => 2,
                'name' => 'Typist',
                'code' => 'TYP',
            ],
            [
                'id' => 8,
                'division_id' => 3,
                'name' => 'Taxation',
                'code' => 'TAX',
            ],
            [
                'id' => 9,
                'division_id' => 4,
                'name' => 'Accounting',
                'code' => 'ACC',
            ],
            [
                'id' => 10,
                'division_id' => 5,
                'name' => 'Audit 1',
                'code' => 'AUD1',
            ],
            [
                'id' => 11,
                'division_id' => 5,
                'name' => 'Audit 2',
                'code' => 'AUD2',
            ],
            [
                'id' => 12,
                'division_id' => 5,
                'name' => 'Audit 3',
                'code' => 'AUD3',
            ],
            [
                'id' => 13,
                'division_id' => 5,
                'name' => 'Audit 4',
                'code' => 'AUD4',
            ],
            [
                'id' => 14,
                'division_id' => 5,
                'name' => 'Audit 5',
                'code' => 'AUD5',
            ],
            [
                'id' => 15,
                'division_id' => 5,
                'name' => 'Audit 6',
                'code' => 'AUD6',
            ],
            [
                'id' => 16,
                'division_id' => 5,
                'name' => 'Audit 7',
                'code' => 'AUD7',
            ],
            [
                'id' => 17,
                'division_id' => 5,
                'name' => 'Audit 8',
                'code' => 'AUD8',
            ],
            [
                'id' => 18,
                'division_id' => 5,
                'name' => 'Solis Batam',
                'code' => 'SOLBTM',
            ]
        ];
        DB::table('groups')->insert($data);

        // UPDATE masteremployee
        // SET divisi = 1
        // WHERE divisi = 'Partner';

        // UPDATE masteremployee
        // SET divisi = 2
        // WHERE divisi = 'HRD';

        // UPDATE masteremployee
        // SET divisi = 3
        // WHERE divisi = 'FINANCE';

        // UPDATE masteremployee
        // SET divisi = 4
        // WHERE divisi = 'IT';

        // UPDATE masteremployee
        // SET divisi = 5
        // WHERE divisi = 'GA';

        // UPDATE masteremployee
        // SET divisi = 6
        // WHERE divisi = 'SEKRETARIS';

        // UPDATE masteremployee
        // SET divisi = 7
        // WHERE divisi = 'TYPIST';

        // UPDATE masteremployee
        // SET divisi = 8
        // WHERE divisi = 'TAX';

        // UPDATE masteremployee
        // SET divisi = 9
        // WHERE divisi = 'ACC';

        // UPDATE masteremployee
        // SET divisi = 10
        // WHERE divisi = 'AUD1';

        // UPDATE masteremployee
        // SET divisi = 11
        // WHERE divisi = 'AUD2';

        // UPDATE masteremployee
        // SET divisi = 12
        // WHERE divisi = 'AUD3';

        // UPDATE masteremployee
        // SET divisi = 13
        // WHERE divisi = 'AUD4';

        // UPDATE masteremployee
        // SET divisi = 14
        // WHERE divisi = 'AUD5';

        // UPDATE masteremployee
        // SET divisi = 15
        // WHERE divisi = 'AUD6';

        // UPDATE masteremployee
        // SET divisi = 16
        // WHERE divisi = 'AUD7';

        // UPDATE masteremployee
        // SET divisi = 17
        // WHERE divisi = 'AUD8';

        // UPDATE masteremployee
        // SET divisi = 14
        // WHERE divisi = 'AUD-5';
    }
}
