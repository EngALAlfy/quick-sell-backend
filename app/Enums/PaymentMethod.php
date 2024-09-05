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
        return array_column(self::cases() , "name" , "value");
    }

    public function getName()
    {
        return Str::headline(strtolower($this->name));
    }
}
