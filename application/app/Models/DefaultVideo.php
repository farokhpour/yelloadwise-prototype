<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultVideo extends Model
{
    protected $fillable = [
        'name',
        'video_file',
        'show_any_time',
        'order',
    ];

    protected $casts = [
        'show_any_time' => 'boolean',
        'order' => 'integer',
    ];

    public static function getRandom()
    {
        return self::orderBy('order')->inRandomOrder()->first();
    }

    public static function getRandomForAnyTime()
    {
        return self::where('show_any_time', true)
            ->orderBy('order')
            ->inRandomOrder()
            ->first();
    }
}
