<?php

namespace App\Filament\Resources\KnightResource\Pages;

use App\Filament\Resources\KnightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKnights extends ListRecords
{
    protected static string $resource = KnightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
