<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicKey extends Model
{
    protected $fillable = ['key', 'is_active', 'confirmed'];
}
