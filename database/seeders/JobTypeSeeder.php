<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_types')->insert([
            ['job_type_name' => 'ข้าราชการ'],
            ['job_type_name' => 'ลูกจ้างประจำ'],
            ['job_type_name' => 'พนักงานราชการทั่วไป'],
            ['job_type_name' => 'พนักงานกระทรวงสาธารณสุข'],
            ['job_type_name' => 'ลูกจ้างชั่วคราว'],
        ]);
    }
}
