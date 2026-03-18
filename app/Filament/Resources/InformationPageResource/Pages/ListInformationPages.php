<?php

namespace App\Filament\Resources\InformationPageResource\Pages;

use App\Filament\Resources\InformationPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInformationPages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = InformationPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
