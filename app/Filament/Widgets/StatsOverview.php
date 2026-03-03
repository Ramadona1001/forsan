<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Horse;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي المستخدمين', User::count())
                ->description('المستخدمين المسجلين')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('الخيول المسجلة', Horse::count())
                ->description(Horse::where('is_for_sale', true)->count() . ' للبيع')
                ->descriptionIcon('heroicon-m-heart')
                ->color('success')
                ->chart([3, 5, 7, 4, 6, 8, 5, 9]),

            Stat::make('الطلبات اليوم', Order::whereDate('created_at', today())->count())
                ->description(Order::where('status', 'pending')->count() . ' قيد الانتظار')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([2, 4, 6, 8, 5, 3, 7, 4]),

            Stat::make('الحجوزات اليوم', Booking::whereDate('date', today())->count())
                ->description(Booking::where('status', 'confirmed')->count() . ' مؤكدة')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->chart([4, 2, 5, 7, 3, 6, 4, 8]),
        ];
    }
}
