<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum UserStatus: string
{
    case active = "active";
    case blocked = "blocked";
    case inactive = "inactive";


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
