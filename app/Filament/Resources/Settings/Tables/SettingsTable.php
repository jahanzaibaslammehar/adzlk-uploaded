<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                ToggleColumn::make('is_stripe_enabled')->label('Enable Stripe'),
                TextColumn::make('verify_profile_price')->label('Verify Profile Price'),
                TextColumn::make('subscribe_whatsapp_link')->label('Subscribe WhatsApp Link'),
                TextColumn::make('subscribe_telegram_link')->label('Subscribe Telegram Link'),
                TextColumn::make('subscribe_twitter_link')->label('Subscribe Twitter Link'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
