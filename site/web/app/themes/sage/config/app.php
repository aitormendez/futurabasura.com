<?php

use Roots\Acorn\ServiceProvider;

return [

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        Genero\Sage\WooCommerce\WooCommerceServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\CustomPostTypeServiceProvider::class,
        App\Providers\WooCustomizationServiceProvider::class,
    ])->toArray(),

    'commands' => [
        App\Console\Commands\ListProviders::class,
    ],

];
