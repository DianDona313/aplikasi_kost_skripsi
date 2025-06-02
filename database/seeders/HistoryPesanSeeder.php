<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryPesanSeeder extends Seeder
{
    public function run()
    {
        DB::table('history_pesans')->insert([
            [
                'penyewa_id' => 1,
                'pesan' => 'Permintaan perbaikan AC',
                'deskripsi' => 'AC tidak dingin di kamar B12, mohon diperbaiki secepatnya.',
                'tanggal_mulai' => '2025-05-01',
                'tanggal_selesai' => '2025-05-02',
                'foto' => 'ac_rusak.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'penyewa_id' => 2,
                'pesan' => 'Permintaan tambahan meja belajar',
                'deskripsi' => 'Mohon disediakan meja belajar tambahan di kamar A5.',
                'tanggal_mulai' => '2025-04-10',
                'tanggal_selesai' => '2025-04-12',
                'foto' => null,
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'penyewa_id' => 3,
                'pesan' => 'Keluhan air mampet',
                'deskripsi' => 'Saluran air di kamar mandi kamar C3 tersumbat.',
                'tanggal_mulai' => '2025-05-05',
                'tanggal_selesai' => '2025-05-06',
                'foto' => 'saluran_mampet.jpg',
                'created_by' => 3,
                'updated_by' => 3,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
