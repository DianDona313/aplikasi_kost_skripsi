<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',

            'fasilitas-list',
            'fasilitas-create',
            'fasilitas-edit',
            'fasilitas-delete',

            'history_pengeluarans-list',
            'history_pengeluarans-create',
            'history_pengeluarans-edit',
            'history_pengeluarans-delete',

            'history_pesans-list',
            'history_pesans-create',
            'history_pesans-edit',
            'history_pesans-delete',

            'jeniskost-list',
            'jeniskost-create',
            'jeniskost-edit',
            'jeniskost-delete',

            'kategori_pengeluarans-list',
            'kategori_pengeluarans-create',
            'kategori_pengeluarans-edit',
            'kategori_pengeluarans-delete',

            'metode_pembayaran-list',
            'metode_pembayaran-create',
            'metode_pembayaran-edit',
            'metode_pembayaran-delete',

            'payment-list',
            'payment-create',
            'payment-edit',
            'payment-delete',

            'pengelola-list',
            'pengelola-create',
            'pengelola-edit',
            'pengelola-delete',

            'pengelola_properti-list',
            'pengelola_properti-create',
            'pengelola_properti-edit',
            'pengelola_properti-delete',

            'penyewa-list',
            'penyewa-create',
            'penyewa-edit',
            'penyewa-delete',

            'peraturan-list',
            'peraturan-create',
            'peraturan-edit',
            'peraturan-delete',

            'properti-list',
            'properti-create',
            'properti-edit',
            'properti-delete',

            'room-list',
            'room-create',
            'room-edit',
            'room-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
