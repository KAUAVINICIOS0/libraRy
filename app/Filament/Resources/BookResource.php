<?php

namespace App\Filament\Resources;

use App\Enums\StatusBookEnum;
use App\Filament\Resources\BookResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->prefixIcon('heroicon-o-book-open')
                            ->required()
                            ->label(__('Title'))
                            ->placeholder('Harry Potter')
                            ->hint(__('This is Title of book')),
                        TextInput::make('isbn')
                            ->required()
                            ->prefixIcon('heroicon-o-document')
                            ->label('ISBN')
                            ->hint(__('International Standard Book Number'))
                            ->placeholder('978-0-306-40615-7'),
                        DatePicker::make('year_published')
                            ->required()
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->label(__('Year of published'))
                            ->native(false)
                            ->hint(__('Select Year of published')),
                        Select::make('author_id')
                            ->required()
                            ->label(__('Author'))
                            ->hint(__('Select Author'))
                            ->prefixIcon('heroicon-o-academic-cap')
                            ->relationship('author', 'name')
                            ->native(false),
                        Select::make('publisher_id')
                            ->required()
                            ->prefixIcon('heroicon-o-home-modern')
                            ->hint(__('Select published'))
                            ->label(__('Publisher'))
                            ->relationship('publisher', 'name')
                            ->native(false),
                        Select::make('category')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->visibleOn('create')
                            ->label(__('Category'))
                            ->hint(__('Category of book'))
                            ->prefixIcon('heroicon-o-tag')
                            ->preload(true)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('isbn')
                    ->searchable()
                    ->label(__('ISBN')),
                TextColumn::make('year_published')
                    ->label(__('Year of published'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author.name')
                    ->label(__('Name of author'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('publisher.name')
                    ->searchable()
                    ->label(__('Name of publisher'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Book');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Books');
    }
}
