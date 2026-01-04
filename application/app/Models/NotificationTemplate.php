<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NotificationTemplate extends Model
{
    protected $fillable = [
        'template_id',
        'type',
        'status',
        'config',
        'preview',
        'admin_comment',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($template) {
            if (!$template->template_id) {
                $template->template_id = 'tpl_' . Str::random(10);
            }
        });
    }

    public function isPending(): bool
    {
        return $this->status === 'PENDING';
    }

    public function isApproved(): bool
    {
        return $this->status === 'APPROVED';
    }

    public function isReturned(): bool
    {
        return $this->status === 'RETURNED';
    }
}
