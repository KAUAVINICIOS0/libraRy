<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookLoanResource\Pages;
use App\Filament\Resources\BookLoanResource\RelationManagers;
use App\Models\BookLoan;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookLoanResource extends Resource
{
    protected static ?string $model = BookLoan::class;

    protected static ?string $modelLabel = 'Empréstimo de Livro';

    protected static ?string $pluralModelLabel = 'Empréstimos de Livros';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-on-rectangle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('book_id')
                    ->searchable()
                    ->preload()
                    ->label('Livro')
                    ->relationship('book', 'title')
                    ->required(),
                Forms\Components\Select::make('customer_id')
                    ->searchable()
                    ->preload()
                    ->label('Cliente')
                    ->relationship('customer', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('book_id')
                    ->toggleable()
                    ->label('Livro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->label('Criado por')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_id')
                    ->label('Cliente')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBookLoans::route('/'),
            'create' => Pages\CreateBookLoan::route('/create'),
            'view' => Pages\ViewBookLoan::route('/{record}'),
            'edit' => Pages\EditBookLoan::route('/{record}/edit'),
        ];
    }
}
