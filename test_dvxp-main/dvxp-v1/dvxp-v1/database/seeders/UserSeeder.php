<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'id'=>'1',
            'tenuser'=>'Le Minh Tung',
            'gioitinh'=>'Nam',
            'ngaysinh'=>'2003-11-11',
            'diachi'=>'hanoi',
            'sdt'=>'3123213',
            'email'=>'tug@gmail.com',
            'password'=>'122132',
            'idchucvu'=>'1'
        ]);
        DB::table('user')->insert([
            'id'=>'2',
            'tenuser'=>'Bui Van Truong',
            'gioitinh'=>'Nam',
            'ngaysinh'=>'2003-1-11',
            'diachi'=>'hanoi',
            'sdt'=>'222222',
            'email'=>'truong@gmail.com',
            'password'=>'123123',
            'idchucvu'=>'2'
        ]);
        DB::table('user')->insert([
            'tenuser'=>'Nguyen Van B',
            'gioitinh'=>'Nam',
            'ngaysinh'=>'2003-3-4',
            'diachi'=>'hanoi',
            'sdt'=>'555555',
            'email'=>'b@gmail.com',
            'password'=>'123123',
            'idchucvu'=>'2'
        ]);
    }
}
