<?php

namespace App\Enums;

use App\Contracts\Enums\ArrayValues;
use App\Contracts\Enums\Colorful;
use App\Contracts\Enums\Label;

enum BooleanStatus: int implements ArrayValues, Colorful, Label
{
    case True = 1;
    case False   = 0;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function color(): string
    {
        return match ($this) {
            self::True  => "Green",
            self::False => "Red"
        };
    }

    public function label(): string
    {
        return match ($this) {
            static::True => "Activo",
            static::False => "Inactivo"
        };
    }
}
