<?php

namespace App\Filament\Resources;

use App\Enums\UserType;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.user.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.user.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.user.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.users_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\Select::make('type')
                            ->label('نوع الحساب')
                            ->options(collect(UserType::cases())->mapWithKeys(fn($type) => [$type->value => $type->label()]))
                            ->required()
                            ->default(UserType::CUSTOMER->value),
                    ])->columns(2),

                Forms\Components\Section::make('كلمة المرور')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('معلومات إضافية')
                    ->schema([
                        Forms\Components\Textarea::make('bio')
                            ->label('نبذة')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('تاريخ تأكيد البريد'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('الهاتف')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn(UserType $state): string => $state->label())
                    ->color(fn(UserType $state): string => match ($state) {
                        UserType::ADMIN => 'danger',
                        UserType::STABLE_OWNER, UserType::STORE_OWNER => 'warning',
                        UserType::TRAINER, UserType::VETERINARIAN => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التسجيل')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options(collect(UserType::cases())->mapWithKeys(fn($type) => [$type->value => $type->label()])),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('نشط'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
