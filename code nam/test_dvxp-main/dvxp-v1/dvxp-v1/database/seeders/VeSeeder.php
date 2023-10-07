<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ve')->insert([
            'id'=>'1',
            'idghe'=>'1',
            'iduser'=>'1',
            'ngaymua'=>'2023-7-7'
        ]);
    }
}
