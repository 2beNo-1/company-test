<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function users()
//    {
//        return $this->belongsTo(User::class, 'administrator_id', 'id');
//    }
}
