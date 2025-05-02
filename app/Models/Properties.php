<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Properties extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'properties'; // Explicitly defining table name if necessary

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'jeniskost_id',
        'foto',
        'deskripsi',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at']; // Enables SoftDeletes

    public $timestamps = true;

    /**
     * Relationship: A property belongs to a type of Kost.
     */
    public function jenisKost()
    {
        return $this->belongsTo(JenisKost::class, 'jeniskost_id');
    }

    /**
     * Relationship: A property can have multiple tenants.
     */
    public function penyewas()
    {
        return $this->hasMany(Penyewa::class);
    }

    public function metode_pembayarans()
    {
        return $this->hasMany(Metode_Pembayaran::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'properti_id');
    }
    public function historyPengeluarans()
    {
        return $this->hasMany(HistoryPengeluaran::class, 'properti_id');
    }
}
