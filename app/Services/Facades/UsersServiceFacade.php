<?php

namespace App\Services\Facades;

use App\Services\UsersService;
use Illuminate\Support\Facades\Facade;

class UsersServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UsersService::class;
    }
}
