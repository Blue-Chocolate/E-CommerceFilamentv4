<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;
}