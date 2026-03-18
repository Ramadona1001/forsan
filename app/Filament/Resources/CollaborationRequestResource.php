<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollaborationRequestResource\Pages;
use App\Models\CollaborationRequest;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CollaborationRequestResource extends Resource
{
    protected static ?string $model = CollaborationRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?int $navigationSort = 7;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.collaboration_request.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.collaboration_request.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.collaboration_request.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('filament.resources.collaboration_request.view.details'))
                    ->schema([
                        TextEntry::make('collaboration.title')
                            ->label(__('filament.resources.collaboration_request.table.collaboration'))
                            ->formatStateUsing(fn ($record) => $record->collaboration
                                ? $record->collaboration->getTranslation('title', app()->getLocale()) ?: $record->collaboration->slug
                                : '—'),
                        TextEntry::make('name')->label(__('filament.resources.collaboration_request.table.name')),
                        TextEntry::make('email')->label(__('filament.resources.collaboration_request.table.email')),
                        TextEntry::make('phone')->label(__('filament.resources.collaboration_request.table.phone')),
                        TextEntry::make('message')->label(__('filament.resources.collaboration_request.table.message'))->columnSpanFull(),
                        TextEntry::make('created_at')->label(__('filament.resources.collaboration_request.table.created_at'))->dateTime('Y-m-d H:i'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('collaboration.title')
                    ->label(__('filament.resources.collaboration_request.table.collaboration'))
                    ->formatStateUsing(fn ($record) => $record->collaboration
                        ? $record->collaboration->getTranslation('title', app()->getLocale()) ?: $record->collaboration->slug
                        : '—')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.collaboration_request.table.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament.resources.collaboration_request.table.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('filament.resources.collaboration_request.table.phone')),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('filament.resources.collaboration_request.table.message'))
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.resources.collaboration_request.table.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollaborationRequests::route('/'),
            'view' => Pages\ViewCollaborationRequest::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
