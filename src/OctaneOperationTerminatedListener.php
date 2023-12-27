<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Octane\Contracts\OperationTerminated;

class OctaneOperationTerminatedListener
{
    public function handle(OperationTerminated $event): void
    {
        $event->app->forgetInstance(TokenRepository::class);
        $event->app->forgetInstance(ClientRepository::class);
    }
}
