<?php

namespace App\Filament\Resources\EquestrianSportResource\Pages;

use App\Filament\Resources\EquestrianSportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEquestrianSport extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = EquestrianSportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
