<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'          =>'CGM',
                'email'         =>'cgm@gmail.com',
                'username'      =>'cgm',
                'password'      =>Hash::make('cgm'),
                'role_id'       => 1,
                'created_at'    =>now()
            ],
            ['name'=>'Finance','email'=>'finance@gmail.com','username'=>'finance','password'=>Hash::make('finance'), 'role_id'=> 2, 'created_at'=>now()],
            ['name'=>'HOD','email'=>'hod@gmail.com','username'=>'hod','password'=>Hash::make('hod'),'role_id'=> 3,  'created_at'=>now()],
            ['name'=>'Procurement','email'=>'procurement@gmail.com','username'=>'procurement','password'=>Hash::make('procurement'), 'role_id'=> 4, 'created_at'=>now()],
            ['name'=>'Admin Asset','email'=>'adminasset@gmail.com','username'=>'adminasset','password'=>Hash::make('adminasset'), 'role_id'=> 5, 'created_at'=>now()],
            ['name'=>'Pegawai','email'=>'pegawai@gmail.com','username'=>'pegawai','password'=>Hash::make('pegawai'), 'role_id'=> 6, 'created_at'=>now()]
        ]);
    }
}
