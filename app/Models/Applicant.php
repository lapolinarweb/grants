<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = ['title', 'firstname', 'lastname', 'type_id'];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function mobiles() {
        return $this->hasMany(Mobile::class);
    }

    public function emails() {
        return $this->hasMany(Email::class);
    }

    public function passports() {
        return $this->hasMany(Passport::class);
    }

    public function publicKeys() {
        return $this->hasMany(PublicKey::class);
    }

    public function countries() {
        return $this->belongsToMany(Country::class);
    }

    public function statuses() {
        return $this->belongsToMany(Status::class);
    }
}
