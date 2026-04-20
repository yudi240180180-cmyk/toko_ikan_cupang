<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    protected $table = 'fishes';
    protected $fillable = ['nama_ikan', 'jenis', 'harga', 'stok', 'gambar'];
    
}
