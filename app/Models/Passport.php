<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $fillable = ['code', 'front', 'back', 'is_active', 'confirmed', 'applicant_id'];

    public function applicant() {
        return $this->belongsToMany(Applicant::class);
    }
}
