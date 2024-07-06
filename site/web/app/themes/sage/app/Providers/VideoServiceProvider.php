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
            return new self();
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
        if (!$videoId) {
            return new WP_Error('no_video_id', 'No video ID provided', ['status' => 400]);
        }

        $videoDetails = $this->getVideoDetails($videoId);
        if (empty($videoDetails)) {
            return new WP_Error('no_encodings', 'No video resolutions found', ['status' => 404]);
        }

        return rest_ensure_response($videoDetails);
    }

    public function getVideoDetails($videoId)
    {
        $apiKey = getenv('BUNNY_KEY');
        $libraryId = 265348;

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
            $resolutions = explode(',', $data['availableResolutions']);
            $videoUrls = [];
            foreach ($resolutions as $resolution) {
                $videoUrls[$resolution] = "https://265348.b-cdn.net/{$videoId}/play_{$resolution}.mp4";
            }

            return [
                'videoUrls' => $videoUrls,
                'thumbnailUrl' => "https://vz-9a0bcf65-610.b-cdn.net/{$videoId}/thumbnail.jpg",
            ];
        }

        return [];
    }
}