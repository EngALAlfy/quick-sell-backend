<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Role extends \Spatie\Permission\Models\Role
{
    use HasTranslations;

    public array $translatable = [
        "title",
    ];

    protected $fillable = [
        'title',
        'name',
        'guard_name',
        'level',
    ];

}
