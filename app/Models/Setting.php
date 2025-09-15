<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'is_stripe_enabled',
        'verify_profile_price',
        'subscribe_whatsapp_link',
        'subscribe_telegram_link',
        'subscribe_twitter_link',
    ];
}
