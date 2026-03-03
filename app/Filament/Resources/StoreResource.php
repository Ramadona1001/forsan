<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;

class StoreResource extends Resource
{
    use Translatable;

    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.store.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.store.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.store.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.ecommerce');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.fields.basic_info'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                            ->label(__('filament.fields.logo'))
                            ->collection('logo')
                            ->image()
                            ->maxSize(2048),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->label(__('filament.fields.cover'))
                            ->collection('cover')
                            ->image()
                            ->maxSize(4096),

                        Forms\Components\Select::make('owner_id')
                            ->label(__('filament.fields.owner'))
                            ->relationship('owner', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.fields.name'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label(__('filament.fields.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make(__('Contact Information'))
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label(__('filament.fields.phone'))
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('email')
                            ->label(__('filament.fields.email'))
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('website')
                            ->label(__('filament.fields.website'))
                            ->url()
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make(__('Location'))
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label(__('filament.fields.address'))
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('city')
                            ->label(__('filament.fields.city'))
                            ->maxLength(100),

                        Forms\Components\TextInput::make('country')
                            ->label(__('filament.fields.country'))
                            ->maxLength(100),

                        Forms\Components\TextInput::make('latitude')
                            ->label(__('Latitude'))
                            ->numeric()
                            ->step(0.0001),

                        Forms\Components\TextInput::make('longitude')
                            ->label(__('Longitude'))
                            ->numeric()
                            ->step(0.0001),
                    ])->columns(2),

                Forms\Components\Section::make(__('Status'))
                    ->schema([
                        Forms\Components\TextInput::make('rating')
                            ->label(__('filament.fields.rating'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1)
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('reviews_count')
                            ->label(__('filament.fields.reviews_count'))
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Toggle::make('is_verified')
                            ->label(__('filament.fields.verified'))
                            ->default(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.fields.active'))
                            ->default(true),

                        Forms\Components\Toggle::make('is_featured')
                            ->label(__('filament.fields.featured'))
                            ->default(false),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament.fields.gallery'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->label(__('filament.fields.gallery'))
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->maxSize(2048)
                            ->maxFiles(20)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')
                    ->label(__('filament.fields.logo'))
                    ->collection('logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('filament.fields.owner'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city')
                    ->label(__('filament.fields.city'))
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('filament.fields.phone'))
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label(__('filament.fields.rating'))
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_verified')
                    ->label(__('filament.fields.verified'))
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.fields.active'))
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('filament.fields.featured'))
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified')
                    ->label(__('filament.fields.verified')),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('filament.fields.active')),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label(__('filament.fields.featured')),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }
}
