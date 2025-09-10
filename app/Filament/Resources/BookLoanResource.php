<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookLoanResource\Pages;
use App\Filament\Resources\BookLoanResource\RelationManagers;
use App\Models\BookLoan;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
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
                Tables\Columns\TextColumn::make('book.title')
                    ->toggleable()
                    ->label('Livro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Criado por')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('book.status')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('status_transfer')
                    ->label('Status da Transferência'),
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
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('finish')
                        ->label('Finalizar Empréstimo')
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->action(function (BookLoan $record) {
                            $record->update(['status_transfer' => 'finished']);
                            Notification::make()
                                ->title('Empréstimo finalizado com sucesso!🌽')
                                ->success()
                                ->send();
                        })
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
