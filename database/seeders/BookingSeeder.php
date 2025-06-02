<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'property_id' => 1,
                'penyewa_id' => 1,
                'room_id' => 1,
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-30',
                'status' => 'pending', // contoh: pending, confirmed, cancelled
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'property_id' => 1,
                'penyewa_id' => 2,
                'room_id' => 2,
                'start_date' => '2025-05-01',
                'end_date' => '2025-05-31',
                'status' => 'confirmed',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'property_id' => 2,
                'penyewa_id' => 3,
                'room_id' => 3,
                'start_date' => '2025-07-01',
                'end_date' => '2025-07-31',
                'status' => 'cancelled',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
