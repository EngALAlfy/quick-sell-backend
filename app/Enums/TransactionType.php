<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum TransactionType: string
{
    case stock = "stock";
    case purchase = "purchase";
    case sale = "sale";

    public static function values(): array
    {
        return array_column(self::cases() , "name" , "value");
    }

    public function getName(): string
    {
        return Str::headline(strtolower($this->name));
    }
}
