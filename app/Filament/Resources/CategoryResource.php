<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.category.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.category.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.category.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات القسم')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $state, Forms\Set $set, ?string $old) {
                                if (($old ?? '') !== $state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('description')
                            ->label('الوصف')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('النوع')
                                    ->options([
                                        'product' => 'منتجات',
                                        'service' => 'خدمات',
                                    ])
                                    ->required()
                                    ->native(false),

                                Forms\Components\Select::make('parent_id')
                                    ->label('القسم الأب')
                                    ->relationship('parent', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->native(false),

                                Forms\Components\TextInput::make('order')
                                    ->label('الترتيب')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('الصورة')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('صورة القسم')
                            ->collection('image')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('الصورة')
                    ->collection('image')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'product' => 'success',
                        'service' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'product' => 'منتجات',
                        'service' => 'خدمات',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('القسم الأب')
                    ->placeholder('رئيسي'),

                Tables\Columns\TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('المنتجات')
                    ->counts('products'),

                Tables\Columns\TextColumn::make('services_count')
                    ->label('الخدمات')
                    ->counts('services'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options([
                        'product' => 'منتجات',
                        'service' => 'خدمات',
                    ]),

                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('القسم الأب')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('الحالة')
                    ->trueLabel('نشط')
                    ->falseLabel('غير نشط'),
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
            ->reorderable('order')
            ->defaultSort('order');
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
