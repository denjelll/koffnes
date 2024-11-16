<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Addon extends Model
{
    use HasFactory;

    protected $table = 'addons';
    protected $primaryKey = 'id_addon';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_addon',
        'nama_addon',
        'harga',
    ];

    public function paketAddon()
    {
        return $this->hasMany(PaketAddon::class, 'id_addon');
    }

    public function detailAddon()
    {
        return $this->hasMany(DetailAddon::class, 'id_addon');
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'paket_addons',
            'id_addon',
            'id_menu',
            'id_addon',
            'id_menu'
        );
    }

}
