<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name'=>'CGM','created_at'=>now()],
            ['name'=>'Finance','created_at'=>now()],
            ['name'=>'HOD','created_at'=>now()],
            ['name'=>'Procurement','created_at'=>now()],
            ['name'=>'Admin Asset','created_at'=>now()],
            ['name'=>'Pegawai','created_at'=>now()]
        ]);
    }
}
