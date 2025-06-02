<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metode_pembayarans')->insert([
            [
                'property_id' => 1, // ID properti yang relevan
                'nama_bank' => 'Bank Mandiri',
                'no_rek' => '123-456-7890',
                'atas_nama' => 'John Doe',
                'created_by' => 1, // ID user yang membuat
                'updated_by' => 1, // ID user yang memperbarui
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'property_id' => 1,
                'nama_bank' => 'Bank BCA',
                'no_rek' => '987-654-3210',
                'atas_nama' => 'Jane Smith',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'property_id' => 2, // ID properti yang relevan
                'nama_bank' => 'Bank BRI',
                'no_rek' => '555-123-4567',
                'atas_nama' => 'Tom Brown',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'property_id' => 2,
                'nama_bank' => 'Bank Danamon',
                'no_rek' => '444-789-0123',
                'atas_nama' => 'Sara Lee',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
