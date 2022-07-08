<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(GroupSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(EmployeePositionSeeder::class);
    }
}
