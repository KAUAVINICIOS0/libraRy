<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Authors')
                    ->columns(2)
                    ->description('Content for authors')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name of Author')
                            ->placeholder('Kaua Vinicios')
                            ->hint('Name')
                            ->required(),
        
                        DatePicker::make('date_birth')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->hint('Date of birth'),
        
                        Textarea::make('biography')
                        ->required()
                        ->hint('Biography of author')
                        ->placeholder('...')
                        ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date_birth'),
                TextColumn::make('biography')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(10),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'view' => Pages\ViewAuthor::route('/{record}'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
