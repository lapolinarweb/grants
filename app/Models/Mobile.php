<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    protected $fillable = ['number', 'is_active', 'confirmed', 'applicant_id'];

    public function applicant() {
        return $this->belongsToMany(Applicant::class);
    }
}
