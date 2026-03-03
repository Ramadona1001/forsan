<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use App\Models\AboutUs;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutUs extends ListRecords
{
    protected static string $resource = AboutUsResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        if (AboutUs::count() === 0) {
            $actions[] = Actions\CreateAction::make();
        }
        return $actions;
    }
}
