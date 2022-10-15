<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    public function songs()
    {
        return $this->belongsToMany(Song::class)->withTimestamps();
    }
}
