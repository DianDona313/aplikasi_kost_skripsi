<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyewa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penyewas';
    protected $fillable = [
        'nama',
        'email',
        'nohp',
        'alamat',
        'jenis_kelamin',
        'foto',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    
    public function metode_pembayarans()
    {
        return $this->hasMany(Metode_Pembayaran::class);
    }
    // public function historyPesan()
    // {
    //     return $this->hasMany(HistoryPesan::class);
    // }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function historyPesan()
    {
        return $this->hasOne(HistoryPesan::class);
    }
    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
