<?php

namespace App\Services\Facades;

use App\Services\AdminsService;
use Illuminate\Support\Facades\Facade;

class AdminsServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdminsService::class;
    }
}
