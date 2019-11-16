<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code', 'symbol', 'flag', 'applicant_id'];

    public function applicants() {
        return $this->belongsToMany(Applicant::class);
    }
}
