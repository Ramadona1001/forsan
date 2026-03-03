<?php

namespace App\Filament\Resources;

use App\Enums\HorseStatus;
use App\Filament\Resources\HorseResource\Pages;
use App\Models\Horse;
use App\Models\Stable;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class HorseResource extends Resource
{
    use Translatable;
    protected static ?string $model = Horse::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.horse.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.horse.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.horse.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.horses_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Horse')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('المعلومات الأساسية')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('main_image')
                                    ->label('الصورة الرئيسية')
                                    ->collection('main_image')
                                    ->required()
                                    ->maxSize(51200)
                                    ->columnSpanFull(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                                    ->label('معرض الصور')
                                    ->collection('gallery')
                                    ->multiple()
                                    ->maxSize(51200)
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('owner_id')
                                    ->label('المالك')
                                    ->relationship('owner', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('stable_id')
                                    ->label('الإسطبل')
                                    ->relationship('stable', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('name')
                                    ->label('الاسم')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->label('الوصف')
                                    ->rows(3),
                                Forms\Components\TextInput::make('breed')
                                    ->label('السلالة')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('color')
                                    ->label('اللون')
                                    ->maxLength(50),
                                Forms\Components\Select::make('gender')
                                    ->label('الجنس')
                                    ->options([
                                        'male' => 'ذكر',
                                        'female' => 'أنثى',
                                    ]),
                                Forms\Components\DatePicker::make('birth_date')
                                    ->label('تاريخ الميلاد'),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('المواصفات')
                            ->schema([
                                Forms\Components\TextInput::make('height')
                                    ->label('الارتفاع (سم)')
                                    ->numeric()
                                    ->suffix('سم'),
                                Forms\Components\TextInput::make('weight')
                                    ->label('الوزن (كجم)')
                                    ->numeric()
                                    ->suffix('كجم'),
                                Forms\Components\TextInput::make('registration_number')
                                    ->label('رقم التسجيل'),
                                Forms\Components\TextInput::make('passport_number')
                                    ->label('رقم جواز السفر'),
                                Forms\Components\TextInput::make('microchip_number')
                                    ->label('رقم الشريحة'),
                                Forms\Components\TagsInput::make('disciplines')
                                    ->label('التخصصات')
                                    ->suggestions([
                                        'قفز الحواجز',
                                        'الترويض',
                                        'سباقات',
                                        'بولو',
                                        'رياضة الفروسية',
                                    ]),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('السعر والحالة')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('السعر')
                                    ->numeric()
                                    ->prefix('ر.س'),
                                Forms\Components\TextInput::make('rent_price_per_day')
                                    ->label('سعر الإيجار اليومي')
                                    ->numeric()
                                    ->prefix('ر.س'),
                                Forms\Components\Select::make('status')
                                    ->label('الحالة')
                                    ->options(collect(HorseStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()]))
                                    ->default(HorseStatus::AVAILABLE->value),
                                Forms\Components\Toggle::make('is_for_sale')
                                    ->label('للبيع'),
                                Forms\Components\Toggle::make('is_for_rent')
                                    ->label('للإيجار'),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('مميز'),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('نشط')
                                    ->default(true),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('النسب')
                            ->schema([
                                Forms\Components\TextInput::make('father_name')
                                    ->label('اسم الأب'),
                                Forms\Components\TextInput::make('mother_name')
                                    ->label('اسم الأم'),
                                Forms\Components\Textarea::make('pedigree')
                                    ->label('سلسلة النسب')
                                    ->rows(4),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('main_image')
                    ->label('الصورة')
                    ->collection('main_image'),
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label('المالك')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('breed')
                    ->label('السلالة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn(HorseStatus $state): string => $state->label())
                    ->color(fn(HorseStatus $state): string => $state->color()),
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_for_sale')
                    ->label('للبيع')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('المشاهدات')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options(collect(HorseStatus::cases())->mapWithKeys(fn($s) => [$s->value => $s->label()])),
                Tables\Filters\TernaryFilter::make('is_for_sale')
                    ->label('للبيع'),
                Tables\Filters\TernaryFilter::make('is_for_rent')
                    ->label('للإيجار'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListHorses::route('/'),
            'create' => Pages\CreateHorse::route('/create'),
            'edit' => Pages\EditHorse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
