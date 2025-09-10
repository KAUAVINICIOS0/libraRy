<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
enum StatusBookEnum: string implements HasLabel, HasColor, HasICon{
    case AVAILABLE = 'Available';
    case BORROWED = 'Borrowed';
    case RESERVED = 'Reserved';

    public function getLabel(): ?string
    {
        return __($this->value);
    }

    public function getColor(): array|string|null
    {
        return match($this){
            self::AVAILABLE => 'success',
            self::BORROWED => 'warning',
            self::RESERVED => 'danger',

        };
    }

    public function getIcon(): string
    {
        return match($this){
            self::AVAILABLE => "heroicon-o-check-circle",
            self::BORROWED => "heroicon-o-exclamation-circle",
            self::RESERVED => "heroicon-o-no-symbol",
        };
    }

}