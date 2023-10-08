<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phim')->insert([
            'id'=>'1',
            'tenphim'=>'Phim A',
            'theloai'=>'hanh dong',
            'noidung'=>'0wqidjdwiqdwiojdioqd',
            'daodien'=>'Khanh',
            'image'=>'images/gNRNBBKaDCqtaWAXOF0TGKPQqp4ucIjxT4LJeUZG.jpg'
        ]);
        DB::table('phim')->insert([
            'id'=>'2',
            'tenphim'=>'Phim B',
            'theloai'=>'kinh di',
            'noidung'=>'wddqjqdjwqoidwq',
            'daodien'=>'Nam',
            'image'=>'images/gNRNBBKaDCqtaWAXOF0TGKPQqp4ucIjxT4LJeUZG.jpg'
        ]);
    }
}
