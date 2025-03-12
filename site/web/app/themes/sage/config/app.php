<?php

use Roots\Acorn\ServiceProvider;

return [

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Application Service Providers...
         */
        App\Providers\CustomPostTypeServiceProvider::class,
    ])->toArray(),

    'commands' => [
        App\Console\Commands\ListProviders::class,
    ],

];
