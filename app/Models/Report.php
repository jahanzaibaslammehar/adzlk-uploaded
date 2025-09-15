<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'ad_id',
        'reason',
        'description',
        'reporter_ip',
        'reporter_user_agent',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the ad that was reported.
     */
    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    /**
     * Get the reason display name.
     */
    public function getReasonDisplayAttribute(): string
    {
        $reasons = [
            'inappropriate' => 'Inappropriate Content',
            'spam' => 'Spam or Misleading',
            'fake' => 'Fake or Scam',
            'offensive' => 'Offensive Language',
            'illegal' => 'Illegal Activity',
            'duplicate' => 'Duplicate Ad',
            'other' => 'Other'
        ];

        return $reasons[$this->reason] ?? $this->reason;
    }
}
