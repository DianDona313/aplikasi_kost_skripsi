<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PengelolaSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengelolas')->insert([
            [
                'nama' => 'Budi Santoso',
                'no_telp_pengelola' => '081234567890',
                'alamat' => 'Jl. Melati No. 12, Jakarta',
                'foto' => 'budi.jpg',
                'deskripsi' => 'Pengelola kost berpengalaman di Jakarta Selatan.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'no_telp_pengelola' => '082233445566',
                'alamat' => 'Jl. Kenanga No. 45, Bandung',
                'foto' => 'siti.jpg',
                'deskripsi' => 'Mengelola beberapa properti kost di daerah kampus.',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'no_telp_pengelola' => '085766554433',
                'alamat' => 'Jl. Mawar No. 9, Yogyakarta',
                'foto' => 'ahmad.jpg',
                'deskripsi' => null, // Nullable field
                'created_by' => 3,
                'updated_by' => 3,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
