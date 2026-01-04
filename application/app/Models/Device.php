<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = [
        'device_id',
        'status',
        'last_status_updated_at',
        'default_route',
        'owner_first_name',
        'owner_last_name',
        'owner_national_id',
        'documents_file',
    ];

    protected $casts = [
        'last_status_updated_at' => 'datetime',
    ];

    public function deviceCalls(): HasMany
    {
        return $this->hasMany(DeviceCall::class);
    }

    public function getOwnerFullNameAttribute(): string
    {
        return $this->owner_first_name . ' ' . $this->owner_last_name;
    }

    public function isLive(): bool
    {
        return $this->status === 'live';
    }

    public function isOffline(): bool
    {
        return $this->status === 'offline';
    }

    public function markAsOnline(): void
    {
        $this->update([
            'status' => 'live',
            'last_status_updated_at' => now(),
        ]);
    }

    public function markAsOffline(): void
    {
        // Don't update last_status_updated_at when marking offline
        $this->update([
            'status' => 'offline',
        ]);
    }
}
