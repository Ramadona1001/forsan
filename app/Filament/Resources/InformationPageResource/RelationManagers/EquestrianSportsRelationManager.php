<?php

namespace App\Filament\Resources\InformationPageResource\RelationManagers;

use App\Models\EquestrianSport;
use App\Models\InformationPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EquestrianSportsRelationManager extends RelationManager
{
    protected static string $relationship = 'equestrianSports';

    protected static ?string $title = null;

    protected static ?string $modelLabel = null;
    protected static ?string $pluralModelLabel = null;

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament.resources.equestrian_sport.plural_label');
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->slug === 'equestrian-sports-overview';
    }

    public function form(Form $form): Form
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
                            ->unique(
                                EquestrianSport::class,
                                'slug',
                                modifyRuleUsing: fn ($rule) => $rule->where('information_page_id', $this->ownerRecord->id),
                                ignoreRecord: true
                            ),
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
                            ->image(),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
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
            ->reorderable('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['title'] = ['ar' => $data['title'] ?? '', 'en' => $data['title'] ?? ''];
                        $data['content'] = ['ar' => $data['content'] ?? '', 'en' => $data['content'] ?? ''];
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->fillForm(fn (EquestrianSport $record): array => [
                        'title' => $record->getTranslation('title', app()->getLocale()) ?: $record->slug,
                        'slug' => $record->slug,
                        'content' => $record->getTranslation('content', app()->getLocale()) ?? '',
                        'is_active' => $record->is_active,
                        'sort_order' => $record->sort_order,
                    ])
                    ->mutateFormDataUsing(function (array $data, EquestrianSport $record): array {
                        $locale = app()->getLocale();
                        $title = is_array($record->title) ? $record->title : ['ar' => $record->title ?? '', 'en' => ''];
                        $content = is_array($record->content) ? $record->content : ['ar' => $record->content ?? '', 'en' => ''];
                        $title[$locale] = $data['title'] ?? '';
                        $content[$locale] = $data['content'] ?? '';
                        $data['title'] = $title;
                        $data['content'] = $content;
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
