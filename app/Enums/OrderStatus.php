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
        return array_column(self::cases() , "name" , "value");
    }

    public function getName()
    {
        return Str::headline(strtolower($this->name));
    }
}
