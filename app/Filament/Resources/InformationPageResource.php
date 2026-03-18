<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationPageResource\Pages;
use App\Filament\Resources\InformationPageResource\RelationManagers;
use App\Models\InformationPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class InformationPageResource extends Resource
{
    use Translatable;

    protected static ?string $model = InformationPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.information_page.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.information_page.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.information_page.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.resources.information_page.sections.basic_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament.resources.information_page.fields.title'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament.resources.information_page.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(InformationPage::class, 'slug', ignoreRecord: true),
                        Forms\Components\RichEditor::make('content')
                            ->label(__('filament.resources.information_page.fields.content'))
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('information-pages'),
                        Forms\Components\Select::make('template')
                            ->label(__('filament.resources.information_page.fields.template'))
                            ->options([
                                InformationPage::TEMPLATE_DEFAULT => __('filament.resources.information_page.fields.template_default'),
                                InformationPage::TEMPLATE_WITH_TABLE => __('filament.resources.information_page.fields.template_with_table'),
                                InformationPage::TEMPLATE_WITH_PRODUCTS_SLIDER => __('filament.resources.information_page.fields.template_with_products_slider'),
                                InformationPage::TEMPLATE_WITH_SPORTS_SLIDER => __('filament.resources.information_page.fields.template_with_sports_slider'),
                            ])
                            ->default(InformationPage::TEMPLATE_DEFAULT)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.resources.information_page.fields.is_active'))
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament.resources.information_page.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament.resources.information_page.sections.slider_images'))
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('slider_images')
                            ->collection('slider_images')
                            ->label(__('filament.resources.information_page.sections.slider_images'))
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->columnSpanFull(),
                    ])->collapsed(),
                Forms\Components\Section::make(__('filament.resources.information_page.sections.extra_section'))
                    ->schema([
                        Forms\Components\TextInput::make('extra_section_title')
                            ->label(__('filament.resources.information_page.fields.extra_section_title')),
                        Forms\Components\RichEditor::make('extra_section_content')
                            ->label(__('filament.resources.information_page.fields.extra_section_content'))
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('table_data')
                            ->label(__('filament.resources.information_page.fields.table_data'))
                            ->schema([
                                Forms\Components\TextInput::make('type')->label(__('filament.resources.information_page.fields.table_type'))->required(),
                                Forms\Components\TextInput::make('date')->label(__('filament.resources.information_page.fields.table_date')),
                                Forms\Components\TextInput::make('time')->label(__('filament.resources.information_page.fields.table_time')),
                                Forms\Components\TextInput::make('place')->label(__('filament.resources.information_page.fields.table_place')),
                                Forms\Components\TextInput::make('details')->label(__('filament.resources.information_page.fields.table_details'))->url(),
                            ])
                            ->columns(5)
                            ->columnSpanFull()
                            ->visible(fn (Forms\Get $get) => $get('template') === InformationPage::TEMPLATE_WITH_TABLE),
                    ])->columns(1)->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.resources.information_page.table.title'))
                    ->formatStateUsing(fn ($record) => $record->getTranslation('title', app()->getLocale()) ?: $record->slug)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament.resources.information_page.table.slug'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('template')
                    ->label(__('filament.resources.information_page.table.template'))
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.information_page.table.is_active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament.resources.information_page.table.sort_order'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.resources.information_page.table.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
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
            RelationManagers\EquestrianSportsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformationPages::route('/'),
            'create' => Pages\CreateInformationPage::route('/create'),
            'edit' => Pages\EditInformationPage::route('/{record}/edit'),
        ];
    }
}
