<?php

namespace App\Filament\Resources\PhotographyResource\Pages;

use App\Filament\Resources\PhotographyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotography extends EditRecord
{
    protected static string $resource = PhotographyResource::class;
    use \Filament\Resources\Pages\EditRecord\Concerns\Translatable;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
