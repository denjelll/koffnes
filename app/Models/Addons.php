<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected $table = 'addons';
    protected $primaryKey = 'id_addons';
    public $incrementing = false;
    protected $keyType = 'string'; 

    protected $fillable = [
        'id_addons',
        'addons_menu'
    ];
}
