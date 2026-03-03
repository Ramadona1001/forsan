<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'service_bookings' => \Filament\Resources\Components\Tab::make(__('general.service_bookings'))
                ->modifyQueryUsing(fn($query) => $query->whereNull('package_id'))
                ->badge(fn() => \App\Models\Booking::whereNull('package_id')->count()),

            'package_bookings' => \Filament\Resources\Components\Tab::make(__('general.package_bookings'))
                ->modifyQueryUsing(fn($query) => $query->whereNotNull('package_id'))
                ->badge(fn() => \App\Models\Booking::whereNotNull('package_id')->count()),
        ];
    }
}
