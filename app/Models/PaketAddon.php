<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketAddon extends Model
{
    use HasFactory;

    protected $table = 'paket_addons';
    protected $primaryKey = 'id_paketaddons';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_paketaddon',
        'id_menu',
        'id_addon',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function addon()
    {
        return $this->belongsTo(Addon::class, 'id_addon');
    }
}
