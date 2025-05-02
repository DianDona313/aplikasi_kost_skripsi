<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengelola extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengelolas'; // Nama tabel

    protected $fillable = [
        'nama',
        'no_telp_pengelola',
        'alamat',
        'foto',
        'deskripsi',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = ['deleted_at'];

    // Relasi ke User yang membuat pengelola
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke User yang mengupdate pengelola
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi ke User yang menghapus pengelola (SoftDeletes)
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
