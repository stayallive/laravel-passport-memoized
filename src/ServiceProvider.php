<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Illuminate\Events\Dispatcher;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Octane\Events\TaskTerminated;
use Laravel\Octane\Events\TickTerminated;
use Laravel\Octane\Events\RequestTerminated;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(Dispatcher $events): void
    {
        $events->listen([
            TickTerminated::class,
            TaskTerminated::class,
            RequestTerminated::class,
        ], OctaneOperationTerminatedListener::class);
    }

    public function register(): void
    {
        $this->app->singleton(TokenRepository::class, MemoizedTokenRepository::class);
        $this->app->extend(
            ClientRepository::class,
            static fn (ClientRepository $repository) => new MemoizedClientRepository(
                $repository->getPersonalAccessClientId(),
                $repository->getPersonalAccessClientSecret(),
            ),
        );
    }
}
