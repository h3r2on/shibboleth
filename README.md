Shibboleth Authentication Driver for Laravel 5
==============================================

This package provides a common sense implementation of Shibboleth in Laravel 5

## Installation

With Composer

    composer require h3r2on/shibboleth

## Configuration

Add the ServiceProvider in `config/app.php`

    H3r2on\Shibboleth\ShibbolethServiceProvider::class,

Publish the config file

    php artisan vendor:publish --provider="H3r2on\Shibboleth\ShibbolethServiceProvider"

Add the config vars to your `.env` file
