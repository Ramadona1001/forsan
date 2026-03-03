<?php

namespace App\Filament\Resources\StableResource\RelationManagers;

use App\Models\StablePackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'packages';

    protected static ?string $title = 'باقات الإسطبل';

    protected static ?string $modelLabel = 'باقة';
    protected static ?string $pluralModelLabel = 'باقات';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('اسم الباقة')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label('الوصف')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label('السعر (ريال)')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->prefix('ر.س'),
                Forms\Components\Toggle::make('is_recommended')
                    ->label('باقة موصى بها'),
                Forms\Components\Toggle::make('is_active')
                    ->label('نشط')
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->label('ترتيب العرض')
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TagsInput::make('features')
                    ->label('المزايا (كل ميزة في سطر)')
                    ->placeholder('أضف ميزة ثم Enter')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->formatStateUsing(fn ($record) => is_array($record->name) ? ($record->name[app()->getLocale()] ?? array_values($record->name)[0] ?? '') : $record->name),
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->formatStateUsing(fn ($state) => number_format($state ?? 0) . ' ر.س'),
                Tables\Columns\IconColumn::make('is_recommended')
                    ->label('موصى بها')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['name'] = ['ar' => $data['name'] ?? '', 'en' => $data['name'] ?? ''];
                        $data['description'] = ['ar' => $data['description'] ?? '', 'en' => $data['description'] ?? ''];
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->fillForm(fn (StablePackage $record): array => [
                        'name' => $record->getTranslation('name', app()->getLocale()) ?: (is_array($record->name) ? (array_values($record->name)[0] ?? '') : $record->name),
                        'description' => $record->getTranslation('description', app()->getLocale()) ?: (is_array($record->description) ? (array_values($record->description)[0] ?? '') : $record->description),
                        'price' => $record->price,
                        'features' => $record->features ?? [],
                        'is_recommended' => $record->is_recommended,
                        'is_active' => $record->is_active,
                        'sort_order' => $record->sort_order,
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['name'] = ['ar' => $data['name'] ?? '', 'en' => $data['name'] ?? ''];
                        $data['description'] = ['ar' => $data['description'] ?? '', 'en' => $data['description'] ?? ''];
                        return $data;
                    })
                    ->using(function (StablePackage $record, array $data): StablePackage {
                        $record->update([
                            'name' => $data['name'] ?? ['ar' => '', 'en' => ''],
                            'description' => $data['description'] ?? ['ar' => '', 'en' => ''],
                            'price' => $data['price'] ?? 0,
                            'features' => $data['features'] ?? [],
                            'is_recommended' => $data['is_recommended'] ?? false,
                            'is_active' => $data['is_active'] ?? true,
                            'sort_order' => $data['sort_order'] ?? 0,
                        ]);
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }
}
