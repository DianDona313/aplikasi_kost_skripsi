<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peraturans extends Model
{
    use SoftDeletes;

    protected $table = 'peraturans';

    protected $fillable = [
        'nama',
        'deskripsi',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];
}
