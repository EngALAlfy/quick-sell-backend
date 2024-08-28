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
        return array_column(self::cases() , "name" , "value");
    }

    public function getName()
    {
        return Str::headline(strtolower($this->name));
    }
}
