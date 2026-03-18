<?php

namespace App\Filament\Resources\InformationPageResource\Pages;

use App\Filament\Resources\InformationPageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInformationPage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = InformationPageResource::class;
}
