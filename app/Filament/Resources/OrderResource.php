<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.order.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.order.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.order.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.ecommerce');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات الطلب')
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->label('رقم الطلب')
                            ->disabled(),
                        Forms\Components\Select::make('user_id')
                            ->label('العميل')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('store_id')
                            ->label('المتجر')
                            ->relationship('store', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status')
                            ->label('حالة الطلب')
                            ->options(collect(OrderStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()]))
                            ->required(),
                        Forms\Components\Select::make('payment_status')
                            ->label('حالة الدفع')
                            ->options(collect(PaymentStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()]))
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('المبالغ')
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')
                            ->label('المجموع الفرعي')
                            ->numeric()
                            ->prefix('ر.س')
                            ->disabled(),
                        Forms\Components\TextInput::make('discount')
                            ->label('الخصم')
                            ->numeric()
                            ->prefix('ر.س'),
                        Forms\Components\TextInput::make('tax')
                            ->label('الضريبة')
                            ->numeric()
                            ->prefix('ر.س'),
                        Forms\Components\TextInput::make('shipping_cost')
                            ->label('الشحن')
                            ->numeric()
                            ->prefix('ر.س'),
                        Forms\Components\TextInput::make('total')
                            ->label('الإجمالي')
                            ->numeric()
                            ->prefix('ر.س')
                            ->disabled(),
                    ])->columns(3),

                Forms\Components\Section::make('ملاحظات')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('ملاحظات العميل')
                            ->rows(2),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('ملاحظات الإدارة')
                            ->rows(2),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('رقم الطلب')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('العميل')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('store.name')
                    ->label('المتجر')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('الإجمالي')
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn(OrderStatus $state): string => $state->label())
                    ->color(fn(OrderStatus $state): string => $state->color()),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('الدفع')
                    ->badge()
                    ->formatStateUsing(fn(PaymentStatus $state): string => $state->label())
                    ->color(fn(PaymentStatus $state): string => $state->color()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options(collect(OrderStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()])),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('حالة الدفع')
                    ->options(collect(PaymentStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()])),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', OrderStatus::PENDING)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
