<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.contact_message.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.contact_message.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.contact_message.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->orderByDesc('created_at');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('filament.fields.name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label(__('filament.fields.email'))->searchable(),
                Tables\Columns\TextColumn::make('subject')->label(__('filament.fields.subject'))->limit(30)->searchable(),
                Tables\Columns\IconColumn::make('read_at')
                    ->label(__('filament.fields.read'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('created_at')->label(__('filament.fields.created_at'))->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('markRead')
                    ->label(__('filament.resources.contact_message.mark_read'))
                    ->icon('heroicon-o-envelope-open')
                    ->action(fn (ContactMessage $record) => $record->update(['read_at' => now()]))
                    ->visible(fn (ContactMessage $record) => ! $record->read_at),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')->label(__('filament.fields.name')),
                TextEntry::make('email')->label(__('filament.fields.email')),
                TextEntry::make('phone')->label(__('filament.fields.phone'))->placeholder('—'),
                TextEntry::make('subject')->label(__('filament.fields.subject')),
                TextEntry::make('message')->label(__('filament.fields.message'))->columnSpanFull()->html(false),
                TextEntry::make('created_at')->label(__('filament.fields.created_at'))->dateTime('Y-m-d H:i'),
            ])->columns(2);
    }
}
