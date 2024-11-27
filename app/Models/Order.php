<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    
    const CREATED_AT = 'waktu_transaksi';
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'id_order',
        'id_user',
        'antrian',
        'customer',
        'meja',
        'tipe_order',
        'metode_pembayaran',
        'status',
        'total_harga',
        'waktu_transaksi',
        'updated_on'
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(DetailOrder::class);
    }
    
    public function cashier()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class, 'id_order');
    }

}
