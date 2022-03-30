<?php

namespace Tests;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;
use Stayallive\Laravel\Passport\Memoized\MemoizedTokenRepository;
use Stayallive\Laravel\Passport\Memoized\MemoizedClientRepository;

class ServiceProviderTest extends TestCase
{
    public function testMemoizedClientRepositoryIsBound(): void
    {
        $this->assertTrue($this->app->bound(ClientRepository::class));

        $repository = $this->app->make(ClientRepository::class);

        $this->assertInstanceOf(MemoizedClientRepository::class, $repository);
    }

    public function testMemoizedTokenRepositoryIsBound(): void
    {
        $this->assertTrue($this->app->bound(TokenRepository::class));

        $repository = $this->app->make(TokenRepository::class);

        $this->assertInstanceOf(MemoizedTokenRepository::class, $repository);
    }
}
