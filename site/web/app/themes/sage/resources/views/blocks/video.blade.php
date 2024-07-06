<div class="video-block">
    @php
        $videoId = isset($data->videoId) ? $data->videoId : null;
        $videoDetails = null;

        if ($videoId) {
            $response = wp_remote_get("https://futurabasura.test/wp-json/fb/v1/video-resolutions?video_id={$videoId}", [
                'sslverify' => false,
            ]);
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $videoDetails = json_decode($body, true);
            }
        }
    @endphp

    @if ($videoDetails && !empty($videoDetails['hlsUrl']))
        <div id="video-player-{{ $videoId }}" data-video-id="{{ $videoId }}" data-thumbnail-url="{{ $videoDetails['thumbnailUrl'] }}"></div>
    @else
        <p>{{ __('No video ID provided or no video resolutions found.', 'sage') }}</p>
    @endif
</div>