<?php

namespace App\Filament\Resources\StableResource\Pages;

use App\Filament\Resources\StableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStables extends ListRecords
{
    protected static string $resource = StableResource::class;
    use ListRecords\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
