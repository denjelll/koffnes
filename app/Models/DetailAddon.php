<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailAddon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_addons';
    protected $primaryKey = 'id_detailaddon';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    const CREATED_AT = 'waktu_transaksi';
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'id_detailaddon',
        'id_addon',
        'id_detailorder',
        'kuantitas',
        'harga',
        'waktu_transaksi',
        'updated_on'
    ];

    protected $dates = ['deleted_at'];

    public function addon()
    {
        return $this->belongsTo(Addon::class, 'id_addon');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_detailorder');
    }
}
