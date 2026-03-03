<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.page.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.page.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.page.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.fields.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('Title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label(__('Slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(Page::class, 'slug', ignoreRecord: true),

                        Forms\Components\Textarea::make('excerpt')
                            ->label(__('Excerpt'))
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label(__('Content'))
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('page-attachments'),
                    ])->columns(2),

                Forms\Components\Section::make(__('SEO'))
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label(__('Meta Title'))
                            ->maxLength(60),

                        Forms\Components\Textarea::make('meta_description')
                            ->label(__('Meta Description'))
                            ->rows(2)
                            ->maxLength(160)
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('meta_keywords')
                            ->label(__('Meta Keywords'))
                            ->placeholder(__('Add keyword'))
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('Status'))
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label(__('Published'))
                            ->default(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label(__('filament.fields.featured'))
                            ->default(false),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label(__('Publish Date'))
                            ->default(now()),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable()
                    ->limit(40)
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label(__('Published'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('filament.fields.featured'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Publish Date'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.fields.created_at'))
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label(__('Published')),

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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
