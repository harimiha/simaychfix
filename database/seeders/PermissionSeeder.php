<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'name'          =>'Controlling',
                'slug'          =>'controlling.menu',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Melaporkan Kerusakan Aset',
                'slug'          =>'reportasset.add',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Melihat Progress',
                'slug'          =>'reportasset.progress',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Menilai Kelayakan Aset',
                'slug'          =>'reportasset.check',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Pencatatan',
                'slug'          =>'recording.menu',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Melihat Database Aset',
                'slug'          =>'asset.index',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Mengisi Aset Register',
                'slug'          =>'asset.add',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Pengadaan',
                'slug'          =>'procurement.menu',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Mengajukan Proposal Harga',
                'slug'          =>'ph.submit',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Mengunggah Invoice',
                'slug'          =>'invoice.add',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Membuat Purchase Order',
                'slug'          =>'po.add',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Meninjau Proposal Harga',
                'slug'          =>'review.index',
                'created_at'    =>now()
            ],
            [
                'name'          =>'Payment',
                'slug'          =>'payment.index',
                'created_at'    => now()
            ],
            [
                'name'          =>'Melihat Progress Pengajuan PH',
                'slug'          =>'ph.progress',
                'created_at'    => now()
            ],
            [
                'name'          =>'Melihat Purchase Order',
                'slug'          =>'po.index',
                'created_at'    => now()
            ],
            [
                'name'          =>'Melihat Progress Invoice',
                'slug'          =>'invoice.index',
                'created_at'    => now()
            ],
            [
                'name'          =>'Daftar Akun',
                'slug'          =>'account.add',
                'created_at'    => now()
            ],
            [
                'name'          =>'Database Akun',
                'slug'          =>'account.index',
                'created_at'    => now()
            ],
            [
                'name'          =>'Mengunggah Summary Quotation',
                'slug'          =>'summary.add',
                'created_at'    => now()
            ],
            [
                'name'          =>'Melihat Summary Quotation',
                'slug'          =>'summary.index',
                'created_at'    => now()
            ],
        ]);
    }
}
