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
use function Filament\Support\get_model_label;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->prefixIcon('heroicon-o-user')
                            ->label(__('Name of Author'))
                            ->placeholder('Kaua Vinicios')
                            ->hint(__('Name'))
                            ->required(),
        
                        DatePicker::make('date_birth')
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-o-calendar')
                            ->displayFormat('d/m/Y')
                            ->label(__('Date of birth'))
                            ->hint(__('Date of birth')),
        
                        Textarea::make('biography')
                        ->required()
                        ->label(__('Biography'))
                        ->hint(__('Biography of author'))
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
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('date_birth')
                    ->dateTime('d/m/Y')
                    ->label(__('Date of birth')),
                TextColumn::make('biography')
                    ->label(__('Biography'))
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
    public static function getModelLabel(): string
    {
        return __('Author');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Authors');
    }
}
