<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function presences() {
        return $this->hasMany(Presence::class);
    }
}
