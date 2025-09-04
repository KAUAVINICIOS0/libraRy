<?php

namespace App\Filament\Resources;

use App\Enums\StatusBookEnum;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Filament\Resources\BookResource\RelationManagers\CategoriesRelationManager;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Books')
                    ->description('Content of books')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Title')
                            ->placeholder('Harry Potter')
                            ->hint('This is Title of book'),
        
                        TextInput::make('isbn')
                            ->required()
                            ->label('ISBN')
                            ->hint('International Standard Book Number')
                            ->placeholder('978-0-306-40615-7'),
        
                        DatePicker::make('year_published')
                            ->required()
                            ->label('Year of published')
                            ->hint('Select Year of published'),
        
                        Select::make('author_id')
                            ->required()
                            ->label('Author')
                            ->hint('Select Author')
                            ->relationship('author', 'name')
                            ->native(false),
        
                        Select::make('publisher_id')
                            ->required()
                            ->hint('Select published')
                            ->label('Publisher')
                            ->relationship('publisher', 'name')
                            ->native(false),
        
                        Select::make('status_book')
                            ->required()
                            ->hint('Select status of book')
                            ->label('Status of book')
                            ->native(false)
                            ->options(StatusBookEnum::class),        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('isbn'),
                TextColumn::make('status_book'),
                TextColumn::make('year_published'),
                TextColumn::make('author.name'),
                TextColumn::make('publisher.name'),
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
}
