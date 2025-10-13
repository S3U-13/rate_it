<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WagePromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wage_promotion')->insert([
            ['wage_promotion_name' => 'ควรเลื่อนขั้นค่าจ้าง 1 ขั้น'],
            ['wage_promotion_name' => 'ควรเลื่อนขั้นค่าจ้าง 0.5 ขั้น'],
            ['wage_promotion_name' => 'ไม่ควรเลื่อนขั้นค่าจ้าง'],
        ]);
    }
}
