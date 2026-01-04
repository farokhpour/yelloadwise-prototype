<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceCall extends Model
{
    protected $fillable = [
        'device_id',
        'route_id',
        'location',
        'query_params',
        'ip_address',
    ];

    protected $casts = [
        'query_params' => 'array',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
