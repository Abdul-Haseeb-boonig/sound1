<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
     protected $fillable = ['user_id', 'rating','rateable_type','rateable_id'];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
