<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StableResource\Pages;
use App\Filament\Resources\StableResource\RelationManagers;
use App\Models\Stable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StableResource extends Resource
{
    use Translatable;

    protected static ?string $model = Stable::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.stable.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.stable.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.stable.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.horses_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('owner_id')
                            ->relationship('owner', 'name')
                            ->label(__('Owner'))
                            ->translateLabel()
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->translateLabel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label(__('Description'))
                            ->translateLabel()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone'))
                            ->translateLabel()
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->translateLabel()
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('website')
                            ->label(__('Website'))
                            ->translateLabel()
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make(__('Location'))
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label(__('Address'))
                            ->translateLabel()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('city')
                            ->label(__('City'))
                            ->translateLabel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->label(__('Country'))
                            ->translateLabel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('stable_type')
                            ->label('نوع الإسطبل')
                            ->placeholder('مثال: قفز، ركوب')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('latitude')
                            ->label(__('Latitude'))
                            ->translateLabel()
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->label(__('Longitude'))
                            ->translateLabel()
                            ->numeric(),
                    ])->columns(2),
                Forms\Components\Section::make('مواعيد العمل والمرافق')
                    ->schema([
                        Forms\Components\KeyValue::make('working_hours')
                            ->label('مواعيد العمل')
                            ->keyLabel('اليوم/الفترة')
                            ->valueLabel('الوقت')
                            ->reorderable(),
                        Forms\Components\TagsInput::make('facilities')
                            ->label('المرافق')
                            ->placeholder('أضف مرفق ثم Enter'),
                    ])->columns(1)->collapsed(),
                Forms\Components\Section::make(__('Status'))
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->translateLabel()
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label(__('Featured'))
                            ->translateLabel(),
                        Forms\Components\Toggle::make('is_verified')
                            ->label(__('Verified'))
                            ->translateLabel(),
                    ])->columns(3),
                Forms\Components\Section::make(__('Images'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->label(__('Cover Image'))
                            ->translateLabel(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->label(__('Gallery'))
                            ->translateLabel()
                            ->multiple(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label(__('Cover'))
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('Owner'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('City'))
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('Featured'))
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
            RelationManagers\PackagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStables::route('/'),
            'create' => Pages\CreateStable::route('/create'),
            'edit' => Pages\EditStable::route('/{record}/edit'),
        ];
    }
}
