<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    public $incrementing = true;

    protected $fillable = [
        'id_menu',
        'id_promo',
        'nama_menu',
        'stock',
        'harga',
        'deskripsi',
        'gambar'
    ];

    protected $with = ['promo'];
    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'id_menu');
    }
    
    public function isi_kategori(){
        return $this->hasMany(Isi_kategori::class, 'id_menu');
    }

    public function addOns()
    {
        return $this->hasMany(AddOn::class, 'id_menu', 'id_menu');
    }
}
