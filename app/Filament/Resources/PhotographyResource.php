<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotographyResource\Pages;
use App\Models\Photography;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PhotographyResource extends Resource
{
    use Translatable;

    protected static ?string $model = Photography::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function getNavigationLabel(): string
    {
        return __('services.photography_services');
    }

    public static function getModelLabel(): string
    {
        return __('services.photography_service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('services.photography_services');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.services_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Service Details')
                    ->tabs([
                        Tabs\Tab::make(__('services.details'))
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label(__('services.title'))
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                        Forms\Components\TextInput::make('slug')
                                            ->label(__('services.slug'))
                                            ->required()
                                            ->unique(ignoreRecord: true),

                                        Forms\Components\TextInput::make('price')
                                            ->label(__('services.start_price'))
                                            ->numeric()
                                            ->prefix(__('services.currency_sar')),
                                    ]),

                                Forms\Components\RichEditor::make('description')
                                    ->label(__('services.description'))
                                    ->columnSpanFull(),

                                Forms\Components\KeyValue::make('features')
                                    ->label(__('services.features'))
                                    ->keyLabel(__('services.feature_key'))
                                    ->valueLabel(__('services.feature_value'))
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('is_active')
                                    ->label(__('services.active'))
                                    ->default(true),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label(__('services.featured'))
                                    ->default(false),
                            ]),

                        Tabs\Tab::make(__('services.packages'))
                            ->schema([
                                Repeater::make('packages')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('services.package_name'))
                                            ->required(),
                                        Forms\Components\TextInput::make('price')
                                            ->label(__('services.price'))
                                            ->required()
                                            ->numeric()
                                            ->prefix(__('services.currency_sar')),
                                        Forms\Components\RichEditor::make('description')
                                            ->label(__('services.description'))
                                            ->columnSpanFull(),
                                        Forms\Components\TagsInput::make('features')
                                            ->label(__('services.package_features'))
                                            ->placeholder(__('services.add_feature')),
                                    ])
                                    ->columns(2)
                                    ->label(__('services.packages')),
                            ]),

                        Tabs\Tab::make(__('services.media'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label(__('services.main_image'))
                                    ->collection('image')
                                    ->image(),

                                SpatieMediaLibraryFileUpload::make('gallery')
                                    ->label(__('services.gallery_top'))
                                    ->collection('gallery')
                                    ->multiple()
                                    ->reorderable()
                                    ->maxFiles(20),

                                Repeater::make('video_gallery')
                                    ->label(__('services.video_gallery'))
                                    ->schema([
                                        FileUpload::make('thumbnail')
                                            ->label(__('services.thumbnail'))
                                            ->image()
                                            ->directory('services/videos'),
                                        Forms\Components\TextInput::make('video_url')
                                            ->label(__('services.video_url'))
                                            ->url()
                                            ->required(),
                                    ])
                                    ->columns(2),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('services.image'))
                    ->collection('image')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('services.title'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('services.start_price'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('services.active'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('services.created_at'))
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPhotographies::route('/'),
            'create' => Pages\CreatePhotography::route('/create'),
            'edit' => Pages\EditPhotography::route('/{record}/edit'),
        ];
    }
}
