<?php

namespace App\Filament\Resources\StableResource\Pages;

use App\Filament\Resources\StableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStable extends EditRecord
{
    protected static string $resource = StableResource::class;
    use EditRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
