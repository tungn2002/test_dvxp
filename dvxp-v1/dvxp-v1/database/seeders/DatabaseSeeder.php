<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(ChucVuSeeder::class);
       $this->call(UserSeeder::class);       
       $this->call(PhimSeeder::class);
       $this->call(PhongSeeder::class);
       $this->call(LichChieuSeeder::class);
       $this->call(GheSeeder::class);
       $this->call(VeSeeder::class);


    }
}
