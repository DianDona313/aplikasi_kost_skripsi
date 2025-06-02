<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kategori_pengeluaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori_pengeluarans')->insert([
            [
                'nama' => 'Listrik',
                'deskripsi' => 'Biaya tagihan listrik bulanan',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Air',
                'deskripsi' => 'Biaya tagihan air PDAM',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Perawatan Gedung',
                'deskripsi' => 'Biaya perbaikan, cat ulang, dan perawatan umum',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kebersihan',
                'deskripsi' => 'Biaya petugas kebersihan dan alat-alat pembersih',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Internet',
                'deskripsi' => 'Biaya langganan WiFi bulanan',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
