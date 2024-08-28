<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum PermissionsGuard: string
{
    case admin = "admin";
    case tagger = "tagger";
    case customer = "customer";

    public static function values()
    {
        return array_column(self::cases() , "name" , "value");
    }

    public function getName()
    {
        return Str::headline(strtolower($this->name));
    }
}
