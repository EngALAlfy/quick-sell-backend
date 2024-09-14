<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum PaymentMethod: string
{
    case card = "card";
    case cash = "cash";
    case wallet = "wallet";

    public static function values()
    {
        $values = self::cases();

        $formattedValues = [];
        foreach ($values as $case) {
            $formattedValues[$case->value] = $case->getName();
        }

        return $formattedValues;
    }

    public function getName()
    {
        return Str::headline(strtolower($this->name));
    }
}
