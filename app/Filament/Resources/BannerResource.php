<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.banner.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.banner.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.banner.plural_label');
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
                        Forms\Components\TextInput::make('title')
                            ->label(__('Internal Name / Alt Text'))
                            ->translateLabel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('link')
                            ->label(__('Link'))
                            ->translateLabel()
                            ->maxLength(255),
                        Forms\Components\Select::make('position')
                            ->label(__('Position'))
                            ->translateLabel()
                            ->options([
                                'top' => 'Top Banners (2 Images)',
                                'middle' => 'Middle Banner (1 Image)',
                            ])
                            ->default('top')
                            ->required(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('Sort Order'))
                            ->translateLabel()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->translateLabel()
                            ->default(true),
                    ]),
                Forms\Components\Section::make(__('Image'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->label(__('Banner Image'))
                            ->translateLabel()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label(__('Image')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('Position'))
                    ->translateLabel()
                    ->badge()
                    ->colors([
                        'primary' => 'top',
                        'success' => 'middle',
                        'warning' => 'bottom',
                    ]),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('Order'))
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
