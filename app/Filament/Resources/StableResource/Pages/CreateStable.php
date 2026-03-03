<?php

namespace App\Filament\Resources\StableResource\Pages;

use App\Filament\Resources\StableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStable extends CreateRecord
{
    protected static string $resource = StableResource::class;
    use CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
