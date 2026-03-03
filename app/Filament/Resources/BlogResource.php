<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;

class BlogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.blog.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.blog.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.blog.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.content_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // Main Content Column
                        Forms\Components\Section::make(__('general.blog_content'))
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label(__('general.blog_title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label(__('general.blog_slug'))
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Blog::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label(__('general.blog_excerpt'))
                                    ->rows(3)
                                    ->maxLength(500),

                                Forms\Components\RichEditor::make('content')
                                    ->label(__('general.blog_body'))
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('blog-attachments'),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column
                        Forms\Components\Section::make(__('general.blog_settings'))
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->label(__('general.blog_featured_image'))
                                    ->collection('featured_image')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675'),

                                Forms\Components\Select::make('author_id')
                                    ->label(__('general.blog_author'))
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->default(auth()->id()),





                                Forms\Components\Toggle::make('is_published')
                                    ->label(__('general.blog_is_published'))
                                    ->default(false),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label(__('general.blog_is_featured'))
                                    ->default(false),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label(__('general.blog_published_at'))
                                    ->default(now()),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured_image')
                    ->label(__('general.blog_image'))
                    ->collection('featured_image')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('general.blog_title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('general.blog_author'))
                    ->searchable()
                    ->sortable(),



                Tables\Columns\IconColumn::make('is_published')
                    ->label(__('general.blog_is_published'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('general.blog_is_featured'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('views_count')
                    ->label(__('general.blog_views_count'))
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('general.blog_published_at'))
                    ->dateTime('Y-m-d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.blog_created_at'))
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([


                Tables\Filters\SelectFilter::make('author')
                    ->relationship('author', 'name')
                    ->label(__('general.blog_author')),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label(__('general.blog_publish_status')),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label(__('general.blog_is_featured')),

                Tables\Filters\TrashedFilter::make()
                    ->label(__('general.blog_deleted')),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
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
