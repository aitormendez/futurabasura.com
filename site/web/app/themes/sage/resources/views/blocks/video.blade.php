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
        } else {
            error_log('Error in wp_remote_get: ' . $response->get_error_message());
        }
    }
@endphp

@dump($videoDetails)

<div class="video-block">
    @if ($videoDetails && !empty($videoDetails['videoUrls']))
        <video controls>
            @foreach ($videoDetails['videoUrls'] as $resolution => $url)
                <source src="{{ $url }}" type="video/mp4" label="{{ $resolution }}">
            @endforeach
            {{ __('Your browser does not support the video tag.', 'sage') }}
        </video>
    @else
        <p>{{ __('No video ID provided or no video resolutions found.', 'sage') }}</p>
    @endif
</div>