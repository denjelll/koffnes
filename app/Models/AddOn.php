<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    protected $table = 'add_ons';
    protected $primaryKey = 'id_addon';
    protected $fillable = [
        'id_menu',
        'nama_addon',
        'harga'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}