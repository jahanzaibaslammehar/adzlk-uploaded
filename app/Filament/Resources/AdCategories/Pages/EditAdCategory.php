<?php

namespace App\Filament\Resources\AdCategories\Pages;

use App\Filament\Resources\AdCategories\AdCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdCategory extends EditRecord
{
    protected static string $resource = AdCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
