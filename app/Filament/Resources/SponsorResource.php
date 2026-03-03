<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SponsorResource\Pages;
use App\Filament\Resources\SponsorResource\RelationManagers;
use App\Models\Sponsor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SponsorResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.sponsor.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.sponsor.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.sponsor.plural_label');
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
                            ->label(__('Internal Name'))
                            ->translateLabel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                            ->label(__('Logo'))
                            ->collection('logo')
                            ->translateLabel()
                            ->required(),
                        Forms\Components\TextInput::make('website')
                            ->label(__('Website Link'))
                            ->translateLabel()
                            ->url()
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')
                    ->label(__('Logo'))
                    ->collection('logo')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label(__('Website'))
                    ->translateLabel()
                    ->url(fn(Sponsor $record) => $record->website)
                    ->openUrlInNewTab()
                    ->limit(30),
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
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
