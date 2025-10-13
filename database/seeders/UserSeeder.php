<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "user01",
                'user_name' => "user_01",
                'password' => Hash::make("user0001"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "1",
                'tier_num' => "3",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "16000",
            ],
            [
                'name' => "user02",
                'user_name' => "user_02",
                'password' => Hash::make("user0002"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "2",
                'tier_num' => "3",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "660",
            ],
            [
                'name' => "user03",
                'user_name' => "user_03",
                'password' => Hash::make("user0003"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "3",
                'tier_num' => "3",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "16000",
            ],
            [
                'name' => "user04",
                'user_name' => "user_04",
                'password' => Hash::make("user0004"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "4",
                'tier_num' => "3",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "16000",
            ],
            [
                'name' => "user05",
                'user_name' => "user_05",
                'password' => Hash::make("user0005"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "5",
                'tier_num' => "3",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "500",
            ],
            [
                'name' => "bossgroup2",
                'user_name' => "bossgroup02",
                'password' => Hash::make("bossgroup02"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "1",
                'tier_num' => "4",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "30000",
            ],
            [
                'name' => "รองผู้อำนวยการ",
                'user_name' => "deputy_director",
                'password' => Hash::make("0615386694"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "1",
                'tier_num' => "11",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "60000",
            ],
            [
                'name' => "ผู้อำนวยการ",
                'user_name' => "director",
                'password' => Hash::make("0615386694"),
                'role' => "user",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "1",
                'tier_num' => "12",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "100000",
            ],

            [
                'name' => "admin01",
                'user_name' => "admin01",
                'password' => Hash::make('admin0001'),
                'role' => "admin",
                'group_num' => "2",
                'job_position_num' => "2",
                'job_type_num' => "1",
                'tier_num' => "4",
                'work_affiliation_num' => "11",
                'contract_start_date' => "2012-01-01",
                'end_date_of_employment_contract' => "2028-01-01",
                'wages' => "30000",
            ],
        ]);
    }
}
