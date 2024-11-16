<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Isi_kategori extends Model
{
    protected $table = 'isi_kategoris';
    protected $primaryKey = 'id_isi_kategori';
    protected $fillable = ['id_kategori', 'id_menu'];

}
