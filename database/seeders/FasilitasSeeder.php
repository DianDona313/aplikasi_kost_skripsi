<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fasilitas')->insert([
            [
                'nama' => 'WiFi',
                'deskripsi' => 'Akses internet tanpa kabel untuk penghuni kost.',
                'created_by' => 1, // Contoh ID user yang membuat
                'updated_by' => 1, // Contoh ID user yang memperbarui
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'AC',
                'deskripsi' => 'Pendingin udara di setiap kamar.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Laundry',
                'deskripsi' => 'Layanan pencucian dan pengeringan pakaian.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Parkir',
                'deskripsi' => 'Area parkir yang tersedia untuk kendaraan penghuni.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
