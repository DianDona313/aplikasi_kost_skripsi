<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryPengeluaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('history_pengeluarans')->insert([
            [
                'property_id' => 1,
                'kategori_pengeluaran_id' => 1, // Listrik
                'nama_pengeluaran' => 'Tagihan Listrik Juni 2025',
                'jumlah_pengeluaran' => 750000,
                'tanggal_pengeluaran' => '2025-06-05',
                'foto' => 'listrik_juni_2025.jpg',
                'penanggung_jawab' => 1,
                'deskripsi' => 'Pembayaran listrik PLN bulan Juni',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'property_id' => 1,
                'kategori_pengeluaran_id' => 2, // Air
                'nama_pengeluaran' => 'Tagihan Air Mei 2025',
                'jumlah_pengeluaran' => 300000,
                'tanggal_pengeluaran' => '2025-05-30',
                'foto' => 'air_mei_2025.jpg',
                'penanggung_jawab' => 1,
                'deskripsi' => 'Pembayaran tagihan PDAM',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'property_id' => 2,
                'kategori_pengeluaran_id' => 3, // Perawatan Gedung
                'nama_pengeluaran' => 'Pengecatan Dinding',
                'jumlah_pengeluaran' => 1500000,
                'tanggal_pengeluaran' => '2025-04-15',
                'foto' => 'cat_dinding_april.jpg',
                'penanggung_jawab' => 2,
                'deskripsi' => 'Cat ulang dinding kamar lantai 2',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
