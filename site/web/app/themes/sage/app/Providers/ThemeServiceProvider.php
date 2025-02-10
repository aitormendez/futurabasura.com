<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        add_action('init', function () {
            load_textdomain('woocommerce-square', WP_LANG_DIR . '/plugins/woocommerce-square-' . get_locale() . '.mo');
        });
    }
}
