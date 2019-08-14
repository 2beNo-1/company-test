<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['staff_id', 'content',];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
