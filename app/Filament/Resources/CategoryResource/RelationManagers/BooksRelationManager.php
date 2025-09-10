<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('name')
                    ->required()
                    ->prefixIcon('heroicon-o-book-open')
                    ->preload(true)
                    ->options(Book::all()->pluck('id', 'name'))
                    ->label(__('Book name')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label(__('Books')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                ActionGroup::make([
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
     public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Book Vinculated');
    }
    public static function getModelLabel(): string
    {
        return __('Books');
    }
}
