<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function isi_kategori()
    {
        return $this->hasMany(Isi_kategori::class, 'id_kategori');
    }
}
