<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Octane\Contracts\OperationTerminated;

class OctaneOperationTerminatedListener
{
    public function handle(OperationTerminated $event): void
    {
        $repositories = [
            $event->app()->make(TokenRepository::class),
            $event->app()->make(ClientRepository::class),
        ];

        foreach ($repositories as $repository) {
            if ($repository instanceof MemoizedRepository) {
                $repository->clearInternalCache();
            }
        }
    }

}
