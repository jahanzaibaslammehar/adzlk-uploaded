<?php

namespace App\Filament\Resources\AdCategories\Pages;

use App\Filament\Resources\AdCategories\AdCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdCategories extends ListRecords
{
    protected static string $resource = AdCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
