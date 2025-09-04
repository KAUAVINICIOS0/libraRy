<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublisherResource\Pages;
use App\Filament\Resources\PublisherResource\RelationManagers;
use App\Models\Publisher;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class PublisherResource extends Resource
{
    protected static ?string $model = Publisher::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create Publishers')
                    ->description('This Section for create new Publishers')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Saraiva')
                            ->hint('Name of Publisher'),
        
                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('exemple@exemple.com')
                            ->hint('Email of Publisher'),
        
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->placeholder('(13) 91181-0519')
                            ->hint('Phone Number of Publisher'),
        
                        TextInput::make('cnpj')
                            ->label('CPNJ')
                            ->placeholder('16.054.842/0001-66')
                            ->hint('Document of Publisher'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('cnpj'),
                TextColumn::make('email'),
                TextColumn::make('phone'),

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
            'index' => Pages\ListPublishers::route('/'),
            'create' => Pages\CreatePublisher::route('/create'),
            'view' => Pages\ViewPublisher::route('/{record}'),
            'edit' => Pages\EditPublisher::route('/{record}/edit'),
        ];
    }
}
