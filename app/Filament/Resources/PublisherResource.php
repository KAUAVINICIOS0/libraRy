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
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name of publisher'))
                            ->placeholder('Saraiva')
                            ->required()
                            ->prefixIcon("heroicon-o-home-modern")
                            ->hint(__('Publisher')),
        
                        TextInput::make('email')
                            ->label('Email')
                            ->prefixIcon('heroicon-o-at-symbol')
                            ->required()
                            ->placeholder('exemple@exemple.com')
                            ->hint(__('Email of Publisher')),
        
                        TextInput::make('phone')
                            ->label(__('Contact'))
                            ->prefixIcon('heroicon-o-device-phone-mobile')
                            ->required()
                            ->placeholder('(13) 91181-0519')
                            ->hint(__('Phone Number of Publisher')),
        
                        TextInput::make('cnpj')
                            ->prefixIcon('heroicon-o-paper-clip')
                            ->label('CPNJ')
                            ->required()
                            ->placeholder('16.054.842/0001-66')
                            ->hint(__('Document of Publisher')),
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
    public static function getModelLabel(): string
    {
        return __('Publisher');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Publishers');
    }
}
