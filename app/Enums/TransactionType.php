<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum TransactionType: string
{
    case stock = "stock";
    case purchase = "purchase";
    case sale = "sale";

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
