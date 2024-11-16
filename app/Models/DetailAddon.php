<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAddon extends Model
{
    use HasFactory;

    protected $table = 'detail_addons';
    protected $primaryKey = 'id_detailaddon';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detailaddon',
        'id_addon',
        'id_detailorder',
        'kuantitas',
        'harga',
    ];

    public function addon()
    {
        return $this->belongsTo(Addon::class, 'id_addon');
    }

    public function detailOrder()
    {
        return $this->belongsTo(DetailOrder::class, 'id_detailorder');
    }
}
