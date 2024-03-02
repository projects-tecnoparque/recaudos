<?php

namespace App\Enums;

use App\Contracts\Enums\ArrayValues;
use App\Contracts\Enums\Label;

enum RoleEnum: string implements ArrayValues, Label
{
    case ADMINISTRADOR = "Administrador";
    case RECAUDADOR   = "Recaudador";
    case CLIENTE   = "Cliente";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            static::ADMINISTRADOR   => 'Administrador',
            static::RECAUDADOR     => 'Recaudador',
            static::CLIENTE     => 'Cliente',
        };
    }
}
