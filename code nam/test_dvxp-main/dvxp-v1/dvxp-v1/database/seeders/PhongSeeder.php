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
            'tenphong'=>'Phong X'
        ]);
        DB::table('phong')->insert([
            'id'=>'2',
            'tenphong'=>'Phong Y'
        ]);
        DB::table('phong')->insert([
            'id'=>'3',
            'tenphong'=>'Phong Z'
        ]);
    }
}
