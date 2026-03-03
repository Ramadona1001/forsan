<?php

namespace App\Filament\Resources\KnightResource\Pages;

use App\Filament\Resources\KnightResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKnight extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = KnightResource::class;
}
