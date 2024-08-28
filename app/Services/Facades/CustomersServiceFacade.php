<?php

namespace App\Services\Facades;

use App\Services\CustomersService;
use Illuminate\Support\Facades\Facade;

class CustomersServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomersService::class;
    }
}
