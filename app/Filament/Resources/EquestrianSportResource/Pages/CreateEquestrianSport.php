<?php

namespace App\Filament\Resources\EquestrianSportResource\Pages;

use App\Filament\Resources\EquestrianSportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEquestrianSport extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = EquestrianSportResource::class;
}
