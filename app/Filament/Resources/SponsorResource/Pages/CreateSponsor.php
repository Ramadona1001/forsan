<?php

namespace App\Filament\Resources\SponsorResource\Pages;

use App\Filament\Resources\SponsorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSponsor extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = SponsorResource::class;
}
