<?php

namespace App\Filament\Resources\SubcategoryResource\Pages;

use App\Filament\Resources\SubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubcategories extends ListRecords
{
    protected static string $resource = SubcategoryResource::class;

    public function getBreadcrumb(): ?string
    {
        return null;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
