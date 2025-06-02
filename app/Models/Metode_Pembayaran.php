<?php

namespace App\Models;

use App\Http\Controllers\PropertiController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metode_Pembayaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "metode_pembayarans";
    protected $fillable = [
        'property_id',
        'nama_bank',
        'no_rek',
        'atas_nama',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function property()
    {
        return $this->hasOne(Properties::class, 'id','property_id');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class, 'metode_pembayaran_id');
    }
    
}
