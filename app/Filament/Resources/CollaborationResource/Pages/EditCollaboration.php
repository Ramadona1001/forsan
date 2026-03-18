<?php

namespace App\Filament\Resources\CollaborationResource\Pages;

use App\Filament\Resources\CollaborationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollaboration extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CollaborationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
