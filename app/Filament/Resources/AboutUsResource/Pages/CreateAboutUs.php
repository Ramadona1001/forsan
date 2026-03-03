<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutUs extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = AboutUsResource::class;
}
