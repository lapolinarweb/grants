<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'description', 'applicant_id'];

    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }
}
