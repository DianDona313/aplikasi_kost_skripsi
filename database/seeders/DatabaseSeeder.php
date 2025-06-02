<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // PermissionTableSeeder::class,
            // CreateAdminUserSeeder::class,
            // JenisSeeder::class,
            // PenyewaSeeder::class,
            PropertiSeeder::class
            // BookingSeeder::class,
            // FasilitasSeeder::class,
            // HistoryPesanSeeder::class,
            // HistoryPengeluaranSeeder::class,
            // Kategori_pengeluaranSeeder::class,
            // MetodePembayaranSeeder::class,
            // PaymentSeeder::class,
            // PengelolaSeeder::class,
            // PeraturanSeeder::class,
            // RoomSeeder::class,

       ]);
    }
}
