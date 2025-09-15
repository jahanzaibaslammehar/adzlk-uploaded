<?php

namespace App\Filament\Resources\AdCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AdCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
