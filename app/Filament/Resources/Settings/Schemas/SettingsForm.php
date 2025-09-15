<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('is_stripe_enabled')
                    ->required(),
                TextInput::make('verify_profile_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs'),
                TextInput::make('subscribe_whatsapp_link')
                    ->required(),
                TextInput::make('subscribe_telegram_link')
                    ->required(),
                TextInput::make('subscribe_twitter_link')
                    ->required(),
            ]);
    }
}
