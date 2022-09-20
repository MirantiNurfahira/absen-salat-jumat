<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = ['id'];
   
    public function mosque() {
        return $this->belongsTo(Mosque::class);
    }

    public function studentcounselor() {
        return $this->belongsTo(Users::class, 'student_counselor_id', 'id');
    }

    public function prayercounselor() {
        return $this->belongsTo(Users::class, 'prayer_counselor_id', 'id');
    }
}
