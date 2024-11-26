<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KoffnesStatus extends Model
{
    use HasFactory;

    protected $table = 'koffnes_statuses';
    protected $fillable = [
        'status_koffnes'
    ];

    public $timestamps = false;
    
}
