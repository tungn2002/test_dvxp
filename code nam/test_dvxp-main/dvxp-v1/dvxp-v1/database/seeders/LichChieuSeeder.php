<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LichChieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('lichchieu')->insert([
            'id'=>'1',
            'idphong'=>'1',
            'idphim'=>'1',
            'ngaychieu'=>'2023-4-4',
            'giochieu'=>'14:00:00',
            'gioketthuc'=>'16:00:00'
        ]);
        DB::table('lichchieu')->insert([
            'id'=>'2',
            'idphong'=>'1',
            'idphim'=>'1',
            'ngaychieu'=>'2023-5-5',
            'giochieu'=>'17:00:00',
            'gioketthuc'=>'19:00:00'
        ]);
    }
}
