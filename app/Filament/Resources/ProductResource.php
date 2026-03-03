<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.product.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.product.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.product.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.ecommerce');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.resources.product.sections.basic_info'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('main_image')
                            ->label(__('filament.resources.product.fields.main_image'))
                            ->collection('main_image')
                            ->required()
                            ->maxSize(12288)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('store_id')
                            ->label(__('filament.resources.product.fields.store'))
                            ->relationship('store', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->label(__('filament.resources.product.fields.category'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.resources.product.fields.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sku')
                            ->label(__('filament.resources.product.fields.sku'))
                            ->unique(ignoreRecord: true)
                            ->maxLength(100),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('filament.resources.product.fields.description'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.resources.product.sections.pricing'))
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label(__('filament.resources.product.fields.price'))
                            ->numeric()
                            ->prefix('ر.س')
                            ->required(),
                        Forms\Components\TextInput::make('compare_price')
                            ->label(__('filament.resources.product.fields.compare_price'))
                            ->numeric()
                            ->prefix('ر.س'),
                        Forms\Components\TextInput::make('cost')
                            ->label(__('filament.resources.product.fields.cost'))
                            ->numeric()
                            ->prefix('ر.س'),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament.resources.product.sections.inventory'))
                    ->schema([
                        Forms\Components\TextInput::make('stock')
                            ->label(__('filament.resources.product.fields.stock'))
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('low_stock_threshold')
                            ->label(__('filament.resources.product.fields.low_stock_threshold'))
                            ->numeric()
                            ->default(5),
                        Forms\Components\Toggle::make('track_inventory')
                            ->label(__('filament.resources.product.fields.track_inventory'))
                            ->default(true),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament.resources.product.sections.media'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->label(__('filament.resources.product.fields.gallery'))
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('filament.resources.product.sections.attributes'))
                    ->schema([
                        Forms\Components\TagsInput::make('attributes.sizes')
                            ->label(__('filament.resources.product.fields.sizes'))
                            ->placeholder(__('filament.resources.product.fields.add_size_placeholder'))
                            ->helperText(__('filament.resources.product.fields.add_size_helper')),
                        Forms\Components\Repeater::make('attributes.colors')
                            ->label(__('filament.resources.product.fields.colors'))
                            ->schema([
                                Forms\Components\ColorPicker::make('value')
                                    ->label(__('filament.resources.product.fields.color'))
                                    ->required(),
                            ])
                            ->grid(4)
                            ->defaultItems(0)
                            ->formatStateUsing(fn($state) => collect($state ?? [])->map(fn($item) => is_array($item) ? $item : ['value' => $item])->all())
                            ->dehydrateStateUsing(fn($state) => collect($state ?? [])->map(fn($item) => $item['value'] ?? null)->filter()->values()->all()),
                    ]),

                Forms\Components\Section::make(__('filament.resources.product.sections.settings'))
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.resources.product.fields.is_active'))
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label(__('filament.resources.product.fields.is_featured')),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('main_image')
                    ->label(__('filament.resources.product.fields.main_image'))
                    ->collection('main_image'),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.product.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('store.name')
                    ->label(__('filament.resources.product.fields.store'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament.resources.product.fields.category'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament.resources.product.fields.price'))
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label(__('filament.resources.product.fields.stock'))
                    ->sortable()
                    ->color(fn(Product $record): string => $record->isLowStock() ? 'danger' : 'success'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.product.fields.is_active'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('filament.resources.product.fields.is_featured'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('sales_count')
                    ->label(__('filament.resources.product.fields.sales'))
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('store_id')
                    ->label(__('filament.resources.product.fields.store'))
                    ->relationship('store', 'name'),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label(__('filament.resources.product.fields.category'))
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('filament.resources.product.fields.is_active')),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label(__('filament.resources.product.fields.is_featured')),
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
