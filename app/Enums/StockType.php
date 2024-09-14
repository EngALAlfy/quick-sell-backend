<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum StockType: string
{
    case purchase = "purchase";
    case return = "return";
    case adjustment = "adjustment";

    public static function values()
    {
        $values = self::cases();

        $formattedValues = [];
        foreach ($values as $case) {
            $formattedValues[$case->value] = $case->getName();
        }

        return $formattedValues;
    }

    public function getName(): string
    {
        return Str::headline(strtolower($this->name));
    }
}
