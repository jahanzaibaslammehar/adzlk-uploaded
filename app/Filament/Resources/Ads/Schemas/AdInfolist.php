<?php

namespace App\Filament\Resources\Ads\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AdInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('poster_id')
                    ->numeric(),
                ImageEntry::make('image')
                 ->getStateUsing(fn ($record) => asset('public/storage/' . $record->image)),
                    // ->disk('public')
                    // ->visibility('public'),
                TextEntry::make('title'),
                TextEntry::make('category_id')
                    ->numeric(),
                TextEntry::make('location'),
                TextEntry::make('price')
                    ->money(),
                IconEntry::make('is_on_whatsapp')
                    ->boolean(),
                IconEntry::make('is_on_telegram')
                    ->boolean(),
                IconEntry::make('is_on_imo')
                    ->boolean(),
                IconEntry::make('is_on_viber')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('is_fake')
                    ->boolean(),
                TextEntry::make('ad_type')
                    ->numeric(),
                TextEntry::make('total_likes')
                    ->numeric(),
                TextEntry::make('total_views')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
