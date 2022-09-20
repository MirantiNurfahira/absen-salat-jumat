<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{


    protected $guarded = ['id'];

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function presences() {
        return $this->hasMany(Presence::class);
    }

    public function presencesStatusTrue() {
        return $this->hasMany(Presence::class)
            ->where('status', 1);
    }

    public function presencesStatusFalse() {
        return $this->hasMany(Presence::class)
            ->where('status', 0);
    }
}
