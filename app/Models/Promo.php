<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';
    protected $primaryKey = 'id_promo';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_promo',
        'diskon',
        'waktu_mulai',
        'waktu_berakhir',
    ];
}
