<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_menu',
        'id_kategoridetail',
        'id_promo',
        'id_addons',
        'nama_menu',
        'stock',
        'harga',
        'deskripsi',
        'gambar'
    ];

    public function kategoriDetail()
    {
        return $this->belongsTo(KategoriDetail::class, 'id_kategoridetail');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }

    public function addons()
    {
        return $this->belongsTo(Addons::class, 'id_addons');
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'id_menu');
    }
}
