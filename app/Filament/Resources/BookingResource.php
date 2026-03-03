<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.booking.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.booking.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.booking.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.services_management');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.fields.booking_info'))
                    ->schema([
                        Forms\Components\TextInput::make('booking_number')
                            ->label(__('filament.fields.booking_number'))
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('user_id')
                            ->label(__('filament.fields.customer'))
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\MorphToSelect::make('bookable')
                            ->label(__('filament.fields.service'))
                            ->types([
                                Forms\Components\MorphToSelect\Type::make(\App\Models\HorseReview::class)
                                    ->titleAttribute('title')
                                    ->label(__('services.horse_reviews')),
                                Forms\Components\MorphToSelect\Type::make(\App\Models\Photography::class)
                                    ->titleAttribute('title')
                                    ->label(__('services.photography_services')),
                                Forms\Components\MorphToSelect\Type::make(\App\Models\Stable::class)
                                    ->titleAttribute('name')
                                    ->label('إسطبل'),
                            ])
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\MorphToSelect::make('package')
                            ->label('الباقة')
                            ->types([
                                Forms\Components\MorphToSelect\Type::make(\App\Models\PhotographyPackage::class)
                                    ->titleAttribute('name')
                                    ->label('باقة تصوير'),
                        Forms\Components\MorphToSelect\Type::make(\App\Models\StablePackage::class)
                            ->titleAttribute('name')
                            ->label('باقة إسطبل'),
                            ])
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('horse_id')
                            ->label(__('filament.fields.horse'))
                            ->relationship('horse', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.fields.timing'))
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label(__('filament.fields.date'))
                            ->required()
                            ->native(false),

                        Forms\Components\TimePicker::make('start_time')
                            ->label(__('filament.fields.start_time'))
                            ->required()
                            ->seconds(false),

                        Forms\Components\TimePicker::make('end_time')
                            ->label(__('filament.fields.end_time'))
                            ->seconds(false),

                        Forms\Components\TextInput::make('duration')
                            ->label(__('filament.fields.duration'))
                            ->numeric()
                            ->suffix('min'),

                        Forms\Components\TextInput::make('price')
                            ->label(__('filament.fields.price'))
                            ->numeric()
                            ->prefix('SAR')
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament.fields.status'))
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label(__('filament.fields.status'))
                            ->options([
                                'pending' => __('Pending'),
                                'confirmed' => __('Confirmed'),
                                'completed' => __('Completed'),
                                'cancelled' => __('Cancelled'),
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\Select::make('payment_status')
                            ->label(__('filament.fields.payment_status'))
                            ->options([
                                'pending' => __('Pending'),
                                'paid' => __('Paid'),
                                'refunded' => __('Refunded'),
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\TextInput::make('payment_method')
                            ->label(__('filament.fields.payment_method'))
                            ->maxLength(50),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament.fields.notes'))
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label(__('filament.fields.customer_notes'))
                            ->rows(3),

                        Forms\Components\Textarea::make('provider_notes')
                            ->label(__('filament.fields.provider_notes'))
                            ->rows(3),

                        Forms\Components\Textarea::make('cancellation_reason')
                            ->label(__('filament.fields.cancellation_reason'))
                            ->rows(2)
                            ->visible(fn($get) => $get('status') === 'cancelled'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')
                    ->label(__('filament.fields.booking_number'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.fields.customer'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('bookable')
                    ->label(__('filament.fields.service'))
                    ->formatStateUsing(function ($record) {
                        $bookable = $record->bookable;
                        if (!$bookable)
                            return '-';
                        if ($bookable instanceof \App\Models\Stable)
                            return $bookable->getTranslation('name', app()->getLocale()) ?: (is_array($bookable->name) ? (array_values($bookable->name)[0] ?? '') : $bookable->name);
                        $state = $bookable->title ?? '';
                        return is_array($state)
                            ? ($state[app()->getLocale()] ?? array_values($state)[0] ?? '')
                            : $state;
                    })
                    ->limit(30),

                Tables\Columns\TextColumn::make('package')
                    ->label('الباقة')
                    ->formatStateUsing(function ($record) {
                        $package = $record->package;
                        if (!$package)
                            return '-';

                        $state = $package->name ?? '';

                        return is_array($state)
                            ? ($state[app()->getLocale()] ?? array_values($state)[0] ?? '')
                            : $state;
                    })
                    ->limit(20)
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                Tables\Columns\TextColumn::make('date')
                    ->label(__('filament.fields.date'))
                    ->date('Y-m-d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label(__('filament.fields.time'))
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament.fields.price'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament.fields.status'))
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'info' => 'completed',
                        'danger' => 'cancelled',
                    ]),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label(__('filament.fields.payment_status'))
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'refunded',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('filament.fields.status'))
                    ->options([
                        'pending' => __('Pending'),
                        'confirmed' => __('Confirmed'),
                        'completed' => __('Completed'),
                        'cancelled' => __('Cancelled'),
                    ]),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label(__('filament.fields.payment_status'))
                    ->options([
                        'pending' => __('Pending'),
                        'paid' => __('Paid'),
                        'refunded' => __('Refunded'),
                    ]),

                Tables\Filters\Filter::make('upcoming')
                    ->label(__('Upcoming'))
                    ->query(fn($query) => $query->where('date', '>=', now()->toDateString())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
