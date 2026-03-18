<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquestrianSportResource\Pages;
use App\Models\EquestrianSport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class EquestrianSportResource extends Resource
{
    use Translatable;

    protected static ?string $model = EquestrianSport::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.equestrian_sport.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.equestrian_sport.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.equestrian_sport.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.resources.equestrian_sport.sections.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament.resources.equestrian_sport.fields.title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament.resources.equestrian_sport.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(EquestrianSport::class, 'slug', ignoreRecord: true),
                        Forms\Components\RichEditor::make('content')
                            ->label(__('filament.resources.equestrian_sport.fields.content'))
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('equestrian-sports'),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.resources.equestrian_sport.fields.is_active'))
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament.resources.equestrian_sport.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament.resources.equestrian_sport.sections.image'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->label(__('filament.resources.equestrian_sport.fields.image'))
                            ->image()
                            ->required(),
                    ])->collapsed(),
                Forms\Components\Section::make(__('filament.resources.equestrian_sport.sections.slider_images'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('slider_images')
                            ->collection('slider_images')
                            ->label(__('filament.resources.equestrian_sport.fields.slider_images'))
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->columnSpanFull(),
                    ])->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('filament.resources.equestrian_sport.fields.image'))
                    ->collection('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.resources.equestrian_sport.table.title'))
                    ->formatStateUsing(fn (EquestrianSport $record) => $record->getTranslation('title', app()->getLocale()) ?: $record->slug)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament.resources.equestrian_sport.table.slug'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament.resources.equestrian_sport.table.sort_order'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.equestrian_sport.table.is_active'))
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquestrianSports::route('/'),
            'create' => Pages\CreateEquestrianSport::route('/create'),
            'edit' => Pages\EditEquestrianSport::route('/{record}/edit'),
        ];
    }
}
