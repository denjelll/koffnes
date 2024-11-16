<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_menu',
        'id_kategori',
        'id_promo',
        'nama_menu',
        'stock',
        'harga',
        'deskripsi',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }


    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'id_menu');
    }
}
