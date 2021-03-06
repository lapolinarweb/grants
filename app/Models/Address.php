<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['street', 'city', 'state', 'zip', 'is_active', 'confirmed', 'applicant_id'];

    public function applicant() {
        return $this->belongsToMany(Applicant::class);
    }
}
