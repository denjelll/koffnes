<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUtama extends Model
{
    use HasFactory;

    protected $table = 'kategori_utama';
    protected $primaryKey = 'id_kategoriutama';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategoriutama',
        'nama_kategori'
    ];
}
