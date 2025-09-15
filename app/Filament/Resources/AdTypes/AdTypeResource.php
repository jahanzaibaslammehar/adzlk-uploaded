<?php

namespace App\Filament\Resources\AdTypes;

use App\Filament\Resources\AdTypes\Pages\CreateAdType;
use App\Filament\Resources\AdTypes\Pages\EditAdType;
use App\Filament\Resources\AdTypes\Pages\ListAdTypes;
use App\Filament\Resources\AdTypes\Schemas\AdTypeForm;
use App\Filament\Resources\AdTypes\Tables\AdTypesTable;
use App\Models\AdType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdTypeResource extends Resource
{
    protected static ?string $model = AdType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'AdType';

    public static function form(Schema $schema): Schema
    {
        return AdTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdTypes::route('/'),
            'create' => CreateAdType::route('/create'),
            'edit' => EditAdType::route('/{record}/edit'),
        ];
    }
}
