<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = ['title', 'firstname', 'lastname', 'type_id'];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function organization() {
        return $this->hasOne(Organization::class);
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

    public function purposes() {
        return $this->hasMany(Purpose::class);
    }

    public function countries() {
        return $this->belongsToMany(Country::class)
            ->withTimestamps();
    }

    public function statuses() {
        return $this->belongsToMany(Status::class, 'applicant_status', 'applicant_id', 'status_id')
            ->withPivot('approved_by', 'comment')
            ->withTimestamps();
    }


    public function originatesIn(Country $country) {
        return $this->countries()->attach($country);
    }

    public function attachStatus(Status $status, User $user, $comment) {
        return $this->statuses()->attach($status->id, ['approved_by' => $user->id, 'comment' =>$comment]);
    }
}
