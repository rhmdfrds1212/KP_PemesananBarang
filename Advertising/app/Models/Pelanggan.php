<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'password'
    ];

    protected $hidden = [
        'password',
    ];
}