<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use WP_Error;

class VideoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the service in the container
        $this->app->singleton('VideoService', function ($app) {
            return new static($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar la ruta de la API REST
        add_action('rest_api_init', function () {
            register_rest_route('fb/v1', '/video-resolutions', [
                'methods' => 'GET',
                'callback' => [$this, 'getVideoResolutionsRest'],
                'permission_callback' => '__return_true',
            ]);
        });
    }

    public function getVideoResolutionsRest($data)
    {
        $videoId = $data->get_param('video_id');
        $libraryId = $data->get_param('library_id') ?? 265348;

        if (!$videoId) {
            return new \WP_Error('no_video_id', 'No video ID provided', ['status' => 400]);
        }

        $videoDetails = $this->getVideoDetails($videoId, $libraryId);
        if (empty($videoDetails)) {
            return new \WP_Error('no_encodings', 'No video resolutions found', ['status' => 404]);
        }

        // Creamos la respuesta con tu contenido
        $response = rest_ensure_response($videoDetails);

        // Añadimos las cabeceras de no-caché
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }



    public function getVideoDetails($videoId, $libraryId)
    {
        $apiKey = getenv('BUNNY_KEY');
        $pullZoneUrl = 'vz-9a0bcf65-610';

        $response = wp_remote_get("https://video.bunnycdn.com/library/{$libraryId}/videos/{$videoId}", [
            'headers' => [
                'AccessKey' => $apiKey,
            ],
        ]);

        if (is_wp_error($response)) {
            return [];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['availableResolutions'])) {
            return [
                'hlsUrl' => "https://{$pullZoneUrl}.b-cdn.net/{$videoId}/playlist.m3u8",
                'thumbnailUrl' => "https://{$pullZoneUrl}.b-cdn.net/{$videoId}/thumbnail.jpg",
            ];
        }

        return [];
    }
}
