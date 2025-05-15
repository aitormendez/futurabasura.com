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

        /**
         * Helper para obtener assets con hash para emails.
         */
        if (!function_exists('email_asset')) {
            function email_asset($path)
            {
                $manifestPath = get_theme_file_path('public/build/manifest.json');

                if (!file_exists($manifestPath)) {
                    trigger_error("Vite manifest not found at {$manifestPath}", E_USER_WARNING);
                    return '';
                }

                $manifest = json_decode(file_get_contents($manifestPath), true);

                if (!is_array($manifest) || !isset($manifest[$path]['file'])) {
                    trigger_error("Asset {$path} not found in Vite manifest.", E_USER_WARNING);
                    return '';
                }

                return get_theme_file_uri('public/build/' . $manifest[$path]['file']);
            }
        }
    }
}
