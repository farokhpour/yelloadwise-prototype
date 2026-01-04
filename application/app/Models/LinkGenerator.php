<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkGenerator extends Model
{
    protected $fillable = [
        'landing_url',
        'utms',
        'generated_link',
        'token',
        'campaign_id',
        'campaign_name',
        'customer_name',
        'campaign_type',
        'total_clicks',
    ];

    protected $casts = [
        'utms' => 'array',
        'total_clicks' => 'integer',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    public function generateLink(): string
    {
        $url = $this->landing_url;
        $params = [];
        
        if (is_array($this->utms)) {
            foreach ($this->utms as $utm) {
                if (isset($utm['key']) && isset($utm['value']) && !empty($utm['key']) && !empty($utm['value'])) {
                    $params[$utm['key']] = $utm['value'];
                }
            }
        }
        
        if (!empty($params)) {
            $url .= (strpos($url, '?') !== false ? '&' : '?') . http_build_query($params);
        }
        
        return $url;
    }

    public function generateToken(): string
    {
        // Generate a unique 8-character token
        do {
            $token = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        } while (self::where('token', $token)->exists());
        
        return $token;
    }

    public function getShortLinkAttribute(): string
    {
        return $this->token ? 'http://ylad.ir/' . $this->token : '';
    }

    public function incrementClick()
    {
        $this->increment('total_clicks');
        
        // Record daily click
        $today = now()->toDateString();
        $clickRecord = LinkClick::where('link_generator_id', $this->id)
            ->where('click_date', $today)
            ->first();
        
        if ($clickRecord) {
            $clickRecord->increment('clicks_count');
        } else {
            LinkClick::create([
                'link_generator_id' => $this->id,
                'click_date' => $today,
                'clicks_count' => 1,
            ]);
        }
    }
}
