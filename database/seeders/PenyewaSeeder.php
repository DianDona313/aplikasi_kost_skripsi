<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penyewas')->insert([
            [
                'nama' => 'Rizky Hidayat',
                'email' => 'rizky@example.com',
                'nohp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'nohp' => '082345678901',
                'alamat' => 'Jl. Kartini No. 5, Bandung',
                'jenis_kelamin' => 'Perempuan',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Andi Saputra',
                'email' => 'andi@example.com',
                'nohp' => '083456789012',
                'alamat' => 'Jl. Sudirman No. 25, Surabaya',
                'jenis_kelamin' => 'Laki-laki',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
