<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum PaymentStatus: string
{
    case pending = "pending";
    case successful = "successful";
    case failed = "failed";

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
