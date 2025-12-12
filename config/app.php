<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name is displayed.
    |
    */
    'name' => 'GeStock App',

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    |
    | This value determines the "version" your application is currently running
    | in. You may want to follow the "semantic versioning" - Given a version
    | number MAJOR.MINOR.PATCH when an update includes breaking changes.
    |
    */
    'version' => '1.0',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to handle errors as well
    | as perform differently based on the current environment.
    |
    */
    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    'debug' => env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */
    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone that will be used by the PHP
    | date and date-time functions. We have set this to a sensible default
    | for you out of the box.
    |
    */
    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the encryption service provider to encrypt all
    | sensitive data. Please set this to a random, 32 character string,
    | otherwise these encrypted strings will not be safe.
    |
    */
    'key' => env('APP_KEY', 'base64:your-secret-key-here'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */
    'providers' => [
        // Core Service Providers
        'App\Providers\AppServiceProvider',
        'App\Providers\AuthServiceProvider',
        'App\Providers\RouteServiceProvider',
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they won't hinder performance.
    |
    */
    'aliases' => [
        'App' => 'App\Facades\AppFacade',
        'Config' => 'App\Facades\ConfigFacade',
        'DB' => 'App\Facades\DBFacade',
        'Log' => 'App\Facades\LogFacade',
        'Auth' => 'App\Facades\AuthFacade',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Features
    |--------------------------------------------------------------------------
    |
    | This array defines the features that are enabled or disabled in the
    | application. Adjust these settings as needed.
    |
    */
    'features' => [
        'authentication' => true,
        'authorization' => true,
        'caching' => true,
        'logging' => true,
        'notifications' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode
    |--------------------------------------------------------------------------
    |
    | When maintenance mode is enabled, all requests will display a
    | maintenance mode message.
    |
    */
    'maintenance' => [
        'driver' => env('MAINTENANCE_DRIVER', 'file'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider.
    |
    */
    'locale' => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

];
