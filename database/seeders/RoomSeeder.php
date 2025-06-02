<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'properti_id' => 1,
                'room_name' => 'Kamar A1',
                'room_deskription' => 'Kamar dengan kasur single, kipas angin, dan meja belajar.',
                'harga' => 750000,
                'is_available' => 'yes',
                'fasilitas' => 'WiFi, Kipas Angin, Meja, Lemari',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'properti_id' => 1,
                'room_name' => 'Kamar A2',
                'room_deskription' => 'Kamar dengan AC dan kamar mandi dalam.',
                'harga' => 1000000,
                'is_available' => 'no',
                'fasilitas' => 'WiFi, AC, Meja, Lemari, Kamar Mandi Dalam',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'properti_id' => 2,
                'room_name' => 'Kamar B1',
                'room_deskription' => null, // Nullable
                'harga' => 850000,
                'is_available' => 'yes',
                'fasilitas' => 'WiFi, Meja, Lemari',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
