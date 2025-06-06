<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailProduk extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'deskripsi', 'ukuran'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
