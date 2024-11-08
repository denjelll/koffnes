<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAddons extends Model
{
    use HasFactory;

    protected $table = 'detail_addons';
    protected $primaryKey = 'id_detailaddons';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detailaddons',
        'id_addons',
        'detail_addons',
        'harga_addons'
    ];

    public function addons()
    {
        return $this->belongsTo(Addons::class, 'id_addons');
    }
}
