<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pemesanan_id', 'metode', 'status', 'catatan',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }
    
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
