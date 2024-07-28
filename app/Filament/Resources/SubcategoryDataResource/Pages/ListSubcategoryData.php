<?php

namespace App\Filament\Resources\SubcategoryDataResource\Pages;

use App\Filament\Resources\SubcategoryDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubcategoryData extends ListRecords
{
    protected static string $resource = SubcategoryDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
