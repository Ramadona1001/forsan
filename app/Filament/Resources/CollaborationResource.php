<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollaborationResource\Pages;
use App\Models\Collaboration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class CollaborationResource extends Resource
{
    use Translatable;

    protected static ?string $model = Collaboration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.collaboration.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.collaboration.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.collaboration.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.resources.collaboration.sections.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament.resources.collaboration.fields.title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament.resources.collaboration.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(Collaboration::class, 'slug', ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('filament.resources.collaboration.fields.description'))
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('collaborations'),
                        Forms\Components\TextInput::make('link_text')
                            ->label(__('filament.resources.collaboration.fields.link_text'))
                            ->maxLength(255)
                            ->placeholder('yomiuri.co.jp'),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.resources.collaboration.fields.is_active'))
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament.resources.collaboration.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament.resources.collaboration.sections.image'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->label(__('filament.resources.collaboration.fields.image'))
                            ->image(),
                    ])->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('filament.resources.collaboration.fields.image'))
                    ->collection('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.resources.collaboration.table.title'))
                    ->formatStateUsing(fn (Collaboration $record) => $record->getTranslation('title', app()->getLocale()) ?: $record->slug)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament.resources.collaboration.table.slug'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament.resources.collaboration.table.sort_order'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.collaboration.table.is_active'))
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
            'index' => Pages\ListCollaborations::route('/'),
            'create' => Pages\CreateCollaboration::route('/create'),
            'edit' => Pages\EditCollaboration::route('/{record}/edit'),
        ];
    }
}
