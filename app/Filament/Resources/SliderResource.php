<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class SliderResource extends Resource
{
    use Translatable;
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.slider.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.slider.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.slider.plural_label');
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
                        Forms\Components\TextInput::make('order')
                            ->label(__('Sort Order'))
                            ->translateLabel()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->translateLabel()
                            ->default(true),
                    ]),
                Forms\Components\Section::make(__('Images'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->label(__('Desktop Image'))
                            ->translateLabel()
                            ->required(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('mobile_image')
                            ->collection('mobile_image')
                            ->label(__('Mobile Image'))
                            ->translateLabel(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label(__('Image'))
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
