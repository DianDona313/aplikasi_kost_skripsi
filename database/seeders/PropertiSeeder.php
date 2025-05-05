<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('properties')->insert([
            [
                'nama' => 'Kost Harapan Jaya',
                'alamat' => 'Jl. Kebon Jeruk No. 12',
                'kota' => 'Jakarta Barat',
                'jeniskost_id' => 1, // Kost Putra
                'foto' => 'kost-harapan.jpg',
                'deskripsi' => 'Kost nyaman dan strategis dekat kampus dan pusat perbelanjaan.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kost Bunga Melati',
                'alamat' => 'Jl. Cikutra No. 22',
                'kota' => 'Bandung',
                'jeniskost_id' => 2, // Kost Putri
                'foto' => 'kost-melati.jpg',
                'deskripsi' => 'Lingkungan tenang, cocok untuk mahasiswi dan pekerja.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kost Harmoni',
                'alamat' => 'Jl. Diponegoro No. 8',
                'kota' => 'Yogyakarta',
                'jeniskost_id' => 3, // Kost Campur
                'foto' => 'kost-harmoni.jpg',
                'deskripsi' => 'Kost campur dengan fasilitas lengkap dan akses mudah ke mana saja.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
