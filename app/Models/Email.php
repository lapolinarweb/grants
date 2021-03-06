<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['address', 'is_active', 'confirmed', 'applicant_id'];

    public function applicant() {
        return $this->belongsToMany(Applicant::class);
    }
}
