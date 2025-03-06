<?php

namespace App\Enum;

enum CoffeeOrderStatus: string
{
    case PENDING = 'PENDING';
    case IN_PROGRESS = 'IN_PROGRESS';
    case DONE = 'DONE';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'En attente',
            self::IN_PROGRESS => 'En cours de préparation',
            self::DONE => 'Prêt',
        };
    }
}