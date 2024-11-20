<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $table = 'detail_orders';
    protected $primaryKey = 'id_detailorder';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detailorder',
        'id_order',
        'id_menus',
        'kuantitas',
        'harga'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
