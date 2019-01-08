<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class base_job_statusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('base_job_statuses')->insert([
            'status_name' => 'Waiting for upfront payment acceptance',
        ]);
    }
}
