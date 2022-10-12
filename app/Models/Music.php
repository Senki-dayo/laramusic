<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $table = "musics";

    // アプリケーション側でcreateなどできない値を記述する
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
}
