<?php

namespace App\Filament\Resources\Posters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PosterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Toggle::make('is_verified')
                    ->required(),
                TextInput::make('otp')
                    ->numeric(),
            ]);
    }
}
