<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{  
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id_event';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_event',
        'nama_event',
        'banner_event',
        'hadiah_event',
        'tanggal_event',
        'jam_event',
        'deskripsi_event'
    ];
}
