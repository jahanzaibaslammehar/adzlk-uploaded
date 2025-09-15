<?php

namespace App\Filament\Resources\Posters;

use App\Filament\Resources\Posters\Pages\CreatePoster;
use App\Filament\Resources\Posters\Pages\EditPoster;
use App\Filament\Resources\Posters\Pages\ListPosters;
use App\Filament\Resources\Posters\Pages\ViewPoster;
use App\Filament\Resources\Posters\Schemas\PosterForm;
use App\Filament\Resources\Posters\Schemas\PosterInfolist;
use App\Filament\Resources\Posters\Tables\PostersTable;
use App\Models\Poster;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PosterResource extends Resource
{
    protected static ?string $model = Poster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Poster';

    public static function form(Schema $schema): Schema
    {
        return PosterForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PosterInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostersTable::configure($table);
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
            'index' => ListPosters::route('/'),
            'create' => CreatePoster::route('/create'),
            'view' => ViewPoster::route('/{record}'),
            'edit' => EditPoster::route('/{record}/edit'),
        ];
    }
}
