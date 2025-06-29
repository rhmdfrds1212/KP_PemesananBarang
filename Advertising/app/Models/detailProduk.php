<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class detailProduk extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'deskripsi', 'ukuran', 'foto'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
