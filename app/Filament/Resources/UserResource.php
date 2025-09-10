<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->regex('/^[a-zA-ZáàãâéèêíïóôõöúçÁÀÃÂÉÈÊÍÏÓÔÕÖÚÇ]+(?:\s[a-zA-ZáàãâéèêíïóôõöúçÁÀÃÂÉÈÊÍÏÓÔÕÖÚÇ]+)*$/u')
                            ->string()
                            ->label(__('User Name'))
                            ->placeholder('Kauã Vinicios')
                            ->prefixIcon('heroicon-s-user')
                            ->hint(__('Write the user name')),
                        TextInput::make('email')
                            ->email()
                            ->label(__('Email'))
                            ->hint(__('Write email'))
                            ->placeholder('exemple@exemple.com')
                            ->prefixIcon('heroicon-o-at-symbol')
                            ->required(),

                        TextInput::make('cpf')
                            ->hint(__('Write the cpf'))
                            ->label('CPF')
                            ->unique('users', 'cpf')
                            ->mask('***.***.***-**')
                            ->prefixIcon('heroicon-o-identification')
                            ->placeholder('___.___.___-__')
                            ->required(),

                        TextInput::make('phone')
                            ->label(__('Phone Number'))
                            ->tel()
                            ->hint(__('Write the phone'))
                            ->prefixIcon('heroicon-o-phone')
                            ->mask('(99) 99999-9999')
                            ->placeholder('(99) 99999-9999'),

                        TextInput::make('password')
                            ->hint(__('Write the password'))
                            ->password()
                            ->visibleOn('create')
                            ->label(__('password'))
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->placeholder('********'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('Email')),
                TextColumn::make('cpf')
                    ->label('CPF')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('Phone Number'))
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('User');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('Human Resources');
    }
}
