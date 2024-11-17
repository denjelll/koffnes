<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPromo extends Model
{
    protected $table = 'menu_promos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_promo',
        'id_menu',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo', 'id_promo');
    }
}
