<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnightResource\Pages;
use App\Models\Knight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class KnightResource extends Resource
{
    use Translatable;

    protected static ?string $model = Knight::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.knight.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.knight.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.knight.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.resources.knight.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        Forms\Components\Textarea::make('description')
                            ->label(__('filament.resources.knight.fields.description'))
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label(__('filament.resources.knight.fields.image'))
                            ->collection('image')
                            ->image()
                            ->nullable(),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament.resources.knight.fields.slug'))
                            ->maxLength(255)
                            ->unique(Knight::class, 'slug', ignoreRecord: true),
                        Forms\Components\TextInput::make('link')
                            ->label(__('filament.resources.knight.fields.link'))
                            ->url()
                            ->maxLength(500),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament.resources.knight.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.resources.knight.fields.is_active'))
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('filament.resources.knight.fields.image'))
                    ->collection('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.knight.fields.name'))
                    ->formatStateUsing(fn (Knight $record) => $record->getTranslation('name', app()->getLocale()) ?: '—')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament.resources.knight.fields.sort_order'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.knight.fields.is_active'))
                    ->boolean(),
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
            'index' => Pages\ListKnights::route('/'),
            'create' => Pages\CreateKnight::route('/create'),
            'edit' => Pages\EditKnight::route('/{record}/edit'),
        ];
    }
}
