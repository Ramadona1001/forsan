<?php

namespace App\Filament\Resources\KnightResource\Pages;

use App\Filament\Resources\KnightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKnight extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = KnightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
