<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainerResource\Pages;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.trainer.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.trainer.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.trainer.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.horses_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.fields.basic_info'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                            ->label(__('filament.fields.photo'))
                            ->collection('photo')
                            ->image()
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('user_id')
                            ->label(__('filament.fields.user'))
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('stable_id')
                            ->label(__('filament.fields.stable'))
                            ->relationship('stable', 'name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\RichEditor::make('bio')
                            ->label(__('filament.fields.bio'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.fields.specializations_experience'))
                    ->schema([
                        Forms\Components\TagsInput::make('specializations')
                            ->label(__('filament.fields.specializations'))
                            ->placeholder(__('Add specialization'))
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('experience_years')
                            ->label(__('filament.fields.experience_years'))
                            ->numeric()
                            ->suffix(__('years'))
                            ->minValue(0),

                        Forms\Components\TextInput::make('hourly_rate')
                            ->label(__('filament.fields.hourly_rate'))
                            ->numeric()
                            ->prefix('SAR')
                            ->minValue(0),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.fields.license'))
                    ->schema([
                        Forms\Components\TextInput::make('license_number')
                            ->label(__('filament.fields.license_number'))
                            ->maxLength(100),

                        Forms\Components\DatePicker::make('license_expiry')
                            ->label(__('filament.fields.license_expiry'))
                            ->native(false),

                        Forms\Components\SpatieMediaLibraryFileUpload::make('certificates')
                            ->label(__('filament.fields.certificates'))
                            ->collection('certificates')
                            ->multiple()
                            ->maxFiles(10)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.fields.stats_status'))
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

                        Forms\Components\TextInput::make('students_count')
                            ->label(__('filament.fields.students_count'))
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                    ->label(__('filament.fields.photo'))
                    ->collection('photo')
                    ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('stable.name')
                    ->label(__('filament.fields.stable'))
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('specializations')
                    ->label(__('filament.fields.specializations'))
                    ->badge()
                    ->limit(2)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('experience_years')
                    ->label(__('filament.fields.experience_years'))
                    ->suffix(' ' . __('years'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('hourly_rate')
                    ->label(__('filament.fields.hourly_rate'))
                    ->money('SAR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label(__('filament.fields.rating'))
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('students_count')
                    ->label(__('filament.fields.students_count'))
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
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
