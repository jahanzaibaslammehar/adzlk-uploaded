<?php

namespace App\Filament\Resources\AdTypes\Pages;

use App\Filament\Resources\AdTypes\AdTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdTypes extends ListRecords
{
    protected static string $resource = AdTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
