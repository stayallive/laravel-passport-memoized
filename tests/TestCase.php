<?php

namespace Tests;

use Laravel\Passport\PassportServiceProvider;
use Orchestra\Testbench\TestCase as LaravelTestCase;
use Stayallive\Laravel\Passport\Memoized\ServiceProvider;

class TestCase extends LaravelTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
            PassportServiceProvider::class,
        ];
    }
}
