<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatusBookEnum: string implements HasLabel{
    case AVAILABLE = 'Available';
    case BORROWED = 'Borrowed';
    case RESERVED = 'Reserved';

    public function getLabel(): ?string{
        return $this->value;
    }
}