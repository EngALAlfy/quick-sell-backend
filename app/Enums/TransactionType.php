<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum TransactionType: string
{
    case open_stock = "open_stock";
    case purchase = "purchase";
    case sell = "sell";
    case sell_return = "sell_return";
    case purchase_return = "purchase_return";
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
