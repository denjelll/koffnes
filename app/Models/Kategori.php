<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDetail extends Model
{
    use HasFactory;

    protected $table = 'kategori_detail';
    protected $primaryKey = 'id_kategoridetail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategoridetail',
        'id_kategoriutama',
        'nama_detail'
    ];

    public function kategoriUtama() 
    {
        return $this->belongsTo(KategoriUtama::class, 'id_kategoriutama');
    }
}
