<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ghe')->insert([
            'id'=>'1',
            'tenghe'=>'A1',
            'idphong'=>'1',
            'idlichchieu'=>'1',
            'giaghe'=>'20000'
        ]);
        DB::table('ghe')->insert([
            'id'=>'2',
            'tenghe'=>'A2',
            'idphong'=>'1',
            'idlichchieu'=>'1',
            'giaghe'=>'20000'
        ]);
        DB::table('ghe')->insert([
            'id'=>'3',
            'tenghe'=>'A3',
            'idphong'=>'1',
            'idlichchieu'=>'1',
            'giaghe'=>'20000'
        ]);
    }
}
