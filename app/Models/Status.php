<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'description'];

    protected $primaryKey = 'name';

    public function applicants() {
        return $this->belongsToMany(Applicant::class);
    }
}
