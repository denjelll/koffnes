<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order',
        'id_user',
        'antrian',
        'customer',
        'meja',
        'tipe_order',
        'status',
        'total_harga',
        'waktu_transaksi'
    ];

    const CREATED_AT = 'waktu_transaksi';
    const UPDATED_AT = null;

    public function items()
    {
        return $this->hasMany(DetailOrder::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }

    // public function detailOrders()
    // {
    //     return $this->hasMany(DetailOrder::class, 'id_order');
    // }
}
