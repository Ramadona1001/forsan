<?php

namespace App\Filament\Resources\EquestrianSportResource\Pages;

use App\Filament\Resources\EquestrianSportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEquestrianSports extends ListRecords
{
    protected static string $resource = EquestrianSportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
