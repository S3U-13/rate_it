<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationComponentFullTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('evaluation_component_full_time_employee')->insert([
            [
                'component_name' => 'ผลงาน',
                'weight_score' => '0.8'
            ],
            [
                'component_name' => 'คุณลักษณะการปฏิบัติงาน',
                'weight_score' => '0.2'
            ],
        ]);
    }
}
