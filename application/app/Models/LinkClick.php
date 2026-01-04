<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    protected $fillable = [
        'link_generator_id',
        'click_date',
        'clicks_count',
    ];

    protected $casts = [
        'click_date' => 'date',
        'clicks_count' => 'integer',
    ];

    public function linkGenerator(): BelongsTo
    {
        return $this->belongsTo(LinkGenerator::class);
    }
}
