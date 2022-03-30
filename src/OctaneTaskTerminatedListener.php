<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Octane\Events\TaskTerminated;

class OctaneTaskTerminatedListener
{
    public function handle(TaskTerminated $event): void
    {
        $event->app->forgetInstance(TokenRepository::class);
        $event->app->forgetInstance(ClientRepository::class);
    }
}
