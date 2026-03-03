<?php

namespace App\Filament\Resources\HorseReviewResource\Pages;

use App\Filament\Resources\HorseReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorseReview extends EditRecord
{
    protected static string $resource = HorseReviewResource::class;

    use \Filament\Resources\Pages\EditRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
