<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Setting::create([
        'is_stripe_enabled' => false,
        'verify_profile_price' => 500,
        'subscribe_whatsapp_link' => "+923111234567",
        'subscribe_telegram_link' => "https://t.me/your_telegram_channel",
        'subscribe_twitter_link' => "https://twitter.com/your_twitter_handle",
    ]);
    }
}
