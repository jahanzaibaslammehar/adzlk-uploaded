<?php

namespace App\Filament\Resources\AdTypes\Pages;

use App\Filament\Resources\AdTypes\AdTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdType extends EditRecord
{
    protected static string $resource = AdTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
