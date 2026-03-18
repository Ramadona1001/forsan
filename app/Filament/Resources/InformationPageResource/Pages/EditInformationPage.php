<?php

namespace App\Filament\Resources\InformationPageResource\Pages;

use App\Filament\Resources\InformationPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformationPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = InformationPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
