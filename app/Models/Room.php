<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rooms';

    protected $fillable = [
        'properti_id',
        'room_name',
        'room_deskription',
        'harga',
        'is_available',
        'fasilitas',
        'foto',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Relasi ke Properti (Many to One)
    public function properti()
    {
        return $this->belongsTo(Properties::class, 'properti_id');
    }

    // Relasi ke Fasilitas (Many to Many)
    public function fasilitas()
    {
        // Ubah ini sesuai dengan struktur tabel pivot Anda
        return $this->belongsToMany(Fasilitas::class, 'room_fasilitas', 'room_id', 'fasilitas_id');
    }
}