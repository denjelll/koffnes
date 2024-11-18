<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';
    protected $primaryKey = 'id_promo';
    
    protected $fillable = [
        'id_promo',
        'diskon',
        'waktu_mulai',
        'waktu_berakhir',
    ];

    protected $with = ['menu'];
    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }
    public function getTanggalMAttribute(){
        return date('j F Y', strtotime($this->tanggal_mulai));
    }
    public function getTanggalBAttribute(){

        return date('j F Y', strtotime($this->tanggal_berakhir));
    }
}
