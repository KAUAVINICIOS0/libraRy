<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->icon('heroicon-s-eye')
                ->outlined(),
            Actions\DeleteAction::make()
                ->icon('heroicon-s-exclamation-triangle')
                ->outlined(),
        ];
    }
}
