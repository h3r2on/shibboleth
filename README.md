Shibboleth Authentication Driver for Laravel 5.1
==============================================

This package provides a common sense implementation of Shibboleth in Laravel 5.1

## Installation

With Composer

    composer require h3r2on/shibboleth

## Configuration

Add the ServiceProvider in `config/app.php`

    H3r2on\Shibboleth\ShibbolethServiceProvider::class,

Publish the config file and migration

    php artisan vendor:publish --provider="H3r2on\Shibboleth\ShibbolethServiceProvider"

Add the config vars to your `.env` file or stick with the defaults.

Swap out the Auth Driver in `config/app.php` change `auth` to `shibboleth`.

## Usage

Just like the provided Laravel auth package everything works the same. Just remember to setup your Apache virtual host up so that you get the shibboleth headers coming through.

## Notes

* This package does not support Laravel 5.2 due to the changes in Auth from 5.1 to 5.2
* This package does not include Roles or Permissions as there are a number of great packages already in existence.
* Currently there is no built-in support for local login, but it's on our todo list.

## Todo

* Figure out if and how to make this testable
* Add local user login support
