<?php

namespace App\Filament\Resources\HorseReviewResource\Pages;

use App\Filament\Resources\HorseReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHorseReviews extends ListRecords
{
    protected static string $resource = HorseReviewResource::class;

    use \Filament\Resources\Pages\ListRecords\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
