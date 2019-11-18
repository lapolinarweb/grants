<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $fillable = ['description', 'confirmed', 'applicant_id'];

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }

    public function attachApplicant(Applicant $applicant) {
        return $this->applicant()->associate($applicant);
    }
}
