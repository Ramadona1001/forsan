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
    protected static ?string $navigationLabel = 'فرساننا';
    protected static ?string $modelLabel = 'فارس';
    protected static ?string $pluralModelLabel = 'فرساننا';
    protected static ?int $navigationSort = 5;

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
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        Forms\Components\Textarea::make('description')
                            ->label('الوصف')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label('الصورة')
                            ->collection('image')
                            ->image()
                            ->nullable(),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط (slug)')
                            ->maxLength(255)
                            ->unique(Knight::class, 'slug', ignoreRecord: true),
                        Forms\Components\TextInput::make('link')
                            ->label('رابط إقرأ المزيد (اختياري)')
                            ->url()
                            ->maxLength(500),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('الصورة')
                    ->collection('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->formatStateUsing(fn (Knight $record) => $record->getTranslation('name', app()->getLocale()) ?: '—')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
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
