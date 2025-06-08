<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'produk_id', 'lokasi_id', 'nama', 'email', 'telepon', 'ukuran', 'jumlah', 'lama_sewa', 'harga_sewa', 'total_harga', 'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }
    
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
    public function pembayaran()
    {
    return $this->hasOne(Pembayaran::class);
    }
}
