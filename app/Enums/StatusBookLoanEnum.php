<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusBookLoanEnum: string implements HasLabel, HasColor, HasIcon
{
    case FINISHED = 'finished';
    case IN_PROGRESS = 'in progress';

    public function getLabel(): ?string
    {
        return __($this->value);
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::FINISHED => 'success',
            self::IN_PROGRESS => 'warning',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::FINISHED => 'heroicon-o-check-circle',
            self::IN_PROGRESS => 'heroicon-o-exclamation-circle',
        };
    }
}
