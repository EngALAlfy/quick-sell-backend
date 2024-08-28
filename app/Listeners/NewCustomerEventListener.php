<?php

namespace App\Listeners;

use App\Events\NewCustomerEvent;

class NewCustomerEventListener
{
    public function __construct()
    {
    }

    public function handle(NewCustomerEvent $event): void
    {

    }
}
