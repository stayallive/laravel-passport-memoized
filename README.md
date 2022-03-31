# Laravel Passport Memoized

[![Latest Version](https://img.shields.io/github/release/stayallive/laravel-passport-memoized.svg?style=flat-square)](https://github.com/stayallive/laravel-passport-memoized/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/github/workflow/status/stayallive/laravel-passport-memoized/CI/master.svg?style=flat-square)](https://github.com/stayallive/laravel-passport-memoized/actions/workflows/ci.yaml)
[![Total Downloads](https://img.shields.io/packagist/dt/stayallive/laravel-passport-memoized.svg?style=flat-square)](https://packagist.org/packages/stayallive/laravel-passport-memoized)

[Laravel Passport](https://github.com/laravel/passport) comes with repositories for the underlying [oauth2-server](https://github.com/thephpleague/oauth2-server) that result in
multiple queries to retrieve the same exact object from the database in a single request. With a good database engine this will have a small impact in the range of
milliseconds but this is still unacceptable and should be avoided if possible.

With a typical Passport token authenticated request you will see that the token is retrieved 3 times and the client is retrieved twice.

This might be patched in future [Laravel Passport](https://github.com/laravel/passport) releases, but until that time you can install this package.

This package replaces the client and token repositories with ones that memoize the results of certain calls that perform database queries to remove the duplicate queries.

It's safe to use with [Laravel Octane](https://github.com/laravel/octane) since we make sure that the memoize cache is cleared after each request to prevent stale caches.

## Why a package?

And not a PR to [Laravel Passport](https://github.com/laravel/passport)? This was [attempted](https://github.com/laravel/passport/pull/1433) in the past but it was decided to not be changed so this package was created as an alternative.

## Installation

```bash
composer require stayallive/laravel-passport-memoized
```

## Usage

You should only have to install this package to benefit, unless you have disable package auto discovery, in that case you will need to add the service provider to
your `config/app.php` manually.

## Security Vulnerabilities

If you discover a security vulnerability within this package, please send an e-mail to Alex Bouma at `alex+security@bouma.me`. All security vulnerabilities will be swiftly
addressed.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
