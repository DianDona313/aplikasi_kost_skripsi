<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeraturanSeeder extends Seeder
{
    public function run()
    {
        DB::table('peraturans')->insert([
            [
                'nama' => 'Jam Malam',
                'deskripsi' => 'Penghuni dilarang keluar/masuk kost setelah pukul 23.00 WIB tanpa izin.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Larangan Merokok',
                'deskripsi' => 'Tidak diperbolehkan merokok di dalam kamar dan area umum.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Tamu Lawan Jenis',
                'deskripsi' => 'Tamu lawan jenis dilarang masuk ke dalam kamar penyewa.',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kebersihan',
                'deskripsi' => 'Penghuni wajib menjaga kebersihan kamar dan area umum kost.',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Pembayaran Tepat Waktu',
                'deskripsi' => 'Pembayaran sewa dilakukan maksimal tanggal 5 setiap bulan.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
