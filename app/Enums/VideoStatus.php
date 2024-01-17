<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum VideoStatus: string implements HasColor, HasLabel
{
    case Error = 'Error';

    case Active = 'Active';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Error => __('Error'),
            self::Active => __('Active'),

        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Error => 'Error',
            self::Active => 'Active',
        };
    }
}
