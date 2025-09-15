<?php

namespace App\Filament\Resources\AdCategories;

use App\Filament\Resources\AdCategories\Pages\CreateAdCategory;
use App\Filament\Resources\AdCategories\Pages\EditAdCategory;
use App\Filament\Resources\AdCategories\Pages\ListAdCategories;
use App\Filament\Resources\AdCategories\Schemas\AdCategoryForm;
use App\Filament\Resources\AdCategories\Tables\AdCategoriesTable;
use App\Models\AdCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdCategoryResource extends Resource
{
    protected static ?string $model = AdCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'AdCategory';

    public static function form(Schema $schema): Schema
    {
        return AdCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdCategoriesTable::configure($table);
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
            'index' => ListAdCategories::route('/'),
            'create' => CreateAdCategory::route('/create'),
            'edit' => EditAdCategory::route('/{record}/edit'),
        ];
    }
}
