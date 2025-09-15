<?php

namespace App\Filament\Resources\AdCategories\Pages;

use App\Filament\Resources\AdCategories\AdCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdCategory extends CreateRecord
{
    protected static string $resource = AdCategoryResource::class;
}
