<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        DB::table('payments')->insert([
            [
                'booking_id' => 1,
                'user_id' => 1,
                'jumlah' => 500000,
                'sisa_pembayaran' => 250000,
                'payment_method' => 'transfer_bank',
                'payment_status' => 'pending',
                'foto' => 'bukti_pembayaran_1.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_id' => 2,
                'user_id' => 2,
                'jumlah' => 1000000,
                'sisa_pembayaran' => 0,
                'payment_method' => 'qris',
                'payment_status' => 'confirmed',
                'foto' => 'bukti_pembayaran_2.jpg',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'booking_id' => 3,
                'user_id' => 3,
                'jumlah' => 300000,
                'sisa_pembayaran' => 550000,
                'payment_method' => 'cash',
                'payment_status' => 'failed',
                'foto' => 'bukti_pembayaran_3.jpg',
                'created_by' => 3,
                'updated_by' => 3,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
