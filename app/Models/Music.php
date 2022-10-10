<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
}

// アプリケーション側でcreateなどできない値を記述する
protected $guarded = [
    'id',
    'created_at',
    'updated_at',
];