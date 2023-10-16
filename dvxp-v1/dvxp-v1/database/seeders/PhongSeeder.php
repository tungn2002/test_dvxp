<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phong')->insert([
            'id'=>'1',
            'tenphong'=>'Phong X',
            'loaiphong'=>'2D',
            'soghe'=>'40'
        ]);
        DB::table('phong')->insert([
            'id'=>'2',
            'tenphong'=>'Phong Y',
            'loaiphong'=>'3D',
            'soghe'=>'40'
        ]);
        DB::table('phong')->insert([
            'id'=>'3',
            'tenphong'=>'Phong Z',
            'loaiphong'=>'2D',
            'soghe'=>'40'
        ]);
    }
}
