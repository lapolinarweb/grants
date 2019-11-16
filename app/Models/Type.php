<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'description'];

    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
