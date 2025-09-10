<?php

namespace App\Filament\Pages\Auth;

use App\Enums\PositionUsersEnum;
use App\Models\Doctor;
use App\Models\Unit;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\Document;

class Register extends BaseRegister
{

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description()
                    ->columns(2)
                    ->schema([
                        $this->getNameFormComponent()
                            ->regex('/^[a-zA-ZáàãâéèêíïóôõöúçÁÀÃÂÉÈÊÍÏÓÔÕÖÚÇ]+(?:\s[a-zA-ZáàãâéèêíïóôõöúçÁÀÃÂÉÈÊÍÏÓÔÕÖÚÇ]+)*$/u')
                            ->string()
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('exemple teste silva'),

                        $this->getEmailFormComponent()
                            ->email()
                            ->prefixIcon('heroicon-o-envelope')
                            ->placeholder('exemple@hotmail.com'),

                        TextInput::make('phone')
                            ->label(__('Phone Number'))
                            ->tel()
                            ->prefixIcon('heroicon-o-phone')
                            ->mask('(99) 99999-9999')
                            ->placeholder('(99) 99999-9999'),

                        TextInput::make('cpf')
                            ->label('CPF')
                            ->unique('users', 'cpf')
                            ->mask('***.***.***-**')
                            ->prefixIcon('heroicon-o-identification')
                            ->placeholder('___.___.___-__')
                            ->required(),


                        $this->getPasswordFormComponent()
                            ->password()
                            ->label(__('password'))
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->placeholder('********'),

                        $this->getPasswordConfirmationFormComponent()
                            ->password()
                            ->label(__('password'))
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->placeholder('********'),
                    ]),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cpf' => $data['cpf'],
            'password' => $data['password'],
        ]);

        return $user;
    }
}
