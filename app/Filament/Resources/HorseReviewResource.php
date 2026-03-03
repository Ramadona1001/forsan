<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorseReviewResource\Pages;
use App\Filament\Resources\HorseReviewResource\RelationManagers;
use App\Models\HorseReview;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class HorseReviewResource extends Resource
{
    use Translatable;

    protected static ?string $model = HorseReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('services.horse_reviews');
    }

    public static function getModelLabel(): string
    {
        return __('services.horse_review');
    }

    public static function getPluralModelLabel(): string
    {
        return __('services.horse_reviews');
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
                        // Tab 1: Service Details
                        Tabs\Tab::make(__('services.details'))
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label(__('services.review_name'))
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('slug')
                                            ->label(__('services.slug'))
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),


                                        Forms\Components\TextInput::make('price')
                                            ->label(__('services.price'))
                                            ->required()
                                            ->numeric()
                                            ->prefix(__('services.currency_sar')),
                                    ]),

                                Forms\Components\RichEditor::make('description')
                                    ->label(__('services.description'))
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label(__('services.active'))
                                            ->default(true),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label(__('services.featured'))
                                            ->default(false),
                                    ]),
                            ]),

                        // Tab 2: Trainer Info
                        Tabs\Tab::make(__('services.trainer_info'))
                            ->schema([
                                Forms\Components\RichEditor::make('trainer_info')
                                    ->label(__('services.about_trainer')),

                                SpatieMediaLibraryFileUpload::make('trainer_image')
                                    ->label(__('services.trainer_image'))
                                    ->collection('trainer_image')
                                    ->image(),
                            ]),

                        // Tab 3: Images & Video Gallery
                        Tabs\Tab::make(__('services.media'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label(__('services.main_image'))
                                    ->collection('image')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9'),

                                SpatieMediaLibraryFileUpload::make('gallery')
                                    ->label(__('services.gallery_top'))
                                    ->collection('gallery')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->maxFiles(10),

                                Repeater::make('video_gallery')
                                    ->label(__('services.video_gallery_bottom'))
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
                    ->label(__('services.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('services.price'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('services.active'))
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('services.featured'))
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
            'index' => Pages\ListHorseReviews::route('/'),
            'create' => Pages\CreateHorseReview::route('/create'),
            'edit' => Pages\EditHorseReview::route('/{record}/edit'),
        ];
    }
}
