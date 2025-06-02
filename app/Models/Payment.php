<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'user_id',
        'jumlah',
        'sisa_pembayaran',
        'payment_method',
        'payment_status',
        'foto',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relasi ke Booking (satu pembayaran hanya untuk satu booking)
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function penyewa()
    {
        return $this->belongsTo(Booking::class, 'penyewa_id');
    }
    public function metodePembayaran()
    {
        return $this->belongsTo(Metode_Pembayaran::class, 'metode_pembayaran_id');
    }

    /**
     * Relasi ke User (satu pembayaran dilakukan oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
