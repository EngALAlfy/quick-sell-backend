<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum OrderStatus: string
{
    case created = "created";
    case received = "received";
    case shipped = "shipped";
    case delivered = "delivered";
    case cancelled = "cancelled";

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
