<?php

namespace App\Filament\Resources\CollaborationResource\Pages;

use App\Filament\Resources\CollaborationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCollaboration extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CollaborationResource::class;
}
