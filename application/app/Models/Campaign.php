<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'video_file',
        'days',
        'cars',
        'locations',
        'link',
        'utms',
        'cost_per_day',
        'status',
        'regulator_comment',
        'approved_at',
        'paid_at',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'locations' => 'array',
        'utms' => 'array',
        'cost_per_day' => 'decimal:2',
        'days' => 'integer',
        'cars' => 'integer',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    // Status helpers
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isWaitingAdminApproval(): bool
    {
        return $this->status === 'waiting_admin_approval';
    }

    public function isWaitingForRegulatorApproval(): bool
    {
        return $this->status === 'waiting_for_regulator_approval';
    }

    public function isWaitingPayment(): bool
    {
        return $this->status === 'waiting_payment';
    }

    public function isWaitingToRun(): bool
    {
        return $this->status === 'waiting_to_run';
    }

    public function isRunning(): bool
    {
        return $this->status === 'running';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function getTotalCostAttribute(): float
    {
        if (!$this->cost_per_day) {
            return 0;
        }
        return $this->cost_per_day * $this->days;
    }
}
