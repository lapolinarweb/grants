<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = ['title', 'firstname', 'lastname', 'type_id'];
}
