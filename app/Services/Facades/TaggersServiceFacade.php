<?php

namespace App\Services\Facades;

use App\Services\TaggersService;
use Illuminate\Support\Facades\Facade;

class TaggersServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TaggersService::class;
    }
}
