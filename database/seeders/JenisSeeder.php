<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jeniskosts')->insert([
            [
                'nama' => 'Kost Putra',
                'deskripsi' => 'Kost khusus untuk laki-laki.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kost Putri',
                'deskripsi' => 'Kost khusus untuk perempuan.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Kost Campur',
                'deskripsi' => 'Kost untuk laki-laki dan perempuan.',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
