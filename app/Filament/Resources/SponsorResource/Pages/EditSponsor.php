<?php

namespace App\Filament\Resources\SponsorResource\Pages;

use App\Filament\Resources\SponsorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsor extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = SponsorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
