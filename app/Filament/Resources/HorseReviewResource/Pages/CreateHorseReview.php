<?php

namespace App\Filament\Resources\HorseReviewResource\Pages;

use App\Filament\Resources\HorseReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHorseReview extends CreateRecord
{
    protected static string $resource = HorseReviewResource::class;

    use \Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
