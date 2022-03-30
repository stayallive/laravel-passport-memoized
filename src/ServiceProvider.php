<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Illuminate\Events\Dispatcher;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Octane\Events\TaskTerminated;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(Dispatcher $events): void
    {
        $events->listen(TaskTerminated::class, OctaneTaskTerminatedListener::class);
    }

    public function register(): void
    {
        $this->app->singleton(TokenRepository::class, MemoizedTokenRepository::class);
        $this->app->extend(ClientRepository::class, static function (ClientRepository $repository) {
            return new MemoizedClientRepository(
                $repository->getPersonalAccessClientId(),
                $repository->getPersonalAccessClientSecret(),
            );
        });
    }
}
