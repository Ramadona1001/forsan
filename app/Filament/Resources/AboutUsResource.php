<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;

class AboutUsResource extends Resource
{
    use Translatable;

    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'من نحن';
    protected static ?string $modelLabel = 'محتوى من نحن';
    protected static ?string $pluralModelLabel = 'من نحن';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('قسم من نحن (الصورة + النص)')
                    ->schema([
                        Forms\Components\FileUpload::make('about_image')
                            ->label('صورة من نحن')
                            ->image()
                            ->directory('about-us')
                            ->nullable(),
                        Forms\Components\TextInput::make('about_title')
                            ->label('عنوان من نحن')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('about_content')
                            ->label('نص من نحن')
                            ->columnSpanFull(),
                    ])->columns(1),
                Forms\Components\Section::make('الرؤية والأهداف')
                    ->schema([
                        Forms\Components\TextInput::make('vision_title')
                            ->label('عنوان الرؤية')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('vision_content')
                            ->label('نص الرؤية')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('goals_title')
                            ->label('عنوان الأهداف')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('goals_content')
                            ->label('نص الأهداف')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(1),
                Forms\Components\Section::make('الاقتباس')
                    ->schema([
                        Forms\Components\Textarea::make('quote_text')
                            ->label('نص الاقتباس')
                            ->rows(2),
                    ]),
                Forms\Components\Section::make('عناوين الأقسام (اختياري)')
                    ->schema([
                        Forms\Components\TextInput::make('services_heading')->label('عنوان خدماتنا'),
                        Forms\Components\TextInput::make('services_subtext')->label('نص فرعي خدماتنا'),
                        Forms\Components\TextInput::make('partners_heading')->label('عنوان الجهات الراعية'),
                        Forms\Components\TextInput::make('knights_heading')->label('عنوان فرساننا'),
                        Forms\Components\TextInput::make('sports_heading')->label('عنوان الرياضات'),
                        Forms\Components\TextInput::make('sports_subtext')->label('نص فرعي الرياضات'),
                    ])->columns(2)->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('about_title')
                    ->label('من نحن')
                    ->formatStateUsing(fn ($record) => $record->getTranslation('about_title', app()->getLocale()) ?: '—')
                    ->limit(40),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('آخر تحديث')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return static::getModel()::count() === 0;
    }
}
