<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'description'];

    protected $primaryKey = 'name';

    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
