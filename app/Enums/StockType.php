<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum StockType: string
{
    case purchase = "purchase";
    case return = "return";
    case adjustment = "adjustment";

    public static function values(): array
    {
        return array_column(self::cases() , "name" , "value");
    }

    public function getName(): string
    {
        return Str::headline(strtolower($this->name));
    }
}
