<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStore extends CreateRecord
{
    protected static string $resource = StoreResource::class;
    use \Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
