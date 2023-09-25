<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChucVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chucvu')->insert([
            'id'=>'1',
            'tenchucvu'=>'Khách hàng'
        ]);
        DB::table('chucvu')->insert([
            'id'=>'2',
            'tenchucvu'=>'Admin'
        ]);
    }
}
