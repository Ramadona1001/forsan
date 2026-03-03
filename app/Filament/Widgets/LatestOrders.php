<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'أحدث الطلبات';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('رقم الطلب')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('العميل'),
                Tables\Columns\TextColumn::make('total')
                    ->label('الإجمالي')
                    ->money('SAR'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn(OrderStatus $state): string => $state->label())
                    ->color(fn(OrderStatus $state): string => $state->color()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime('Y-m-d H:i'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('عرض')
                    ->url(fn(Order $record): string => route('filament.admin.resources.orders.edit', $record))
                    ->icon('heroicon-m-eye'),
            ]);
    }
}
