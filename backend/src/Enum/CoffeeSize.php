<?php

namespace App\Enum;

enum CoffeeSize: string
{
    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case LARGE = 'LARGE';

    public function label(): string
    {
        return match($this) {
            self::SMALL => 'Café court',
            self::MEDIUM => 'Café normal',
            self::LARGE => 'Café long',
        };
    }
}
