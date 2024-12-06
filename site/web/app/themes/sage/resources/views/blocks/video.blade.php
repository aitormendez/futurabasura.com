@php
    $videoId = isset($data->videoId) ? $data->videoId : null;
    $thumbnailUrl = isset($data->thumbnailUrl) ? $data->thumbnailUrl : null;
    $videoDetails = null;

    if ($videoId) {
        $siteUrl = home_url();
        $response = wp_remote_get("{$siteUrl}/wp-json/fb/v1/video-resolutions?video_id={$videoId}", [
            'sslverify' => false,
        ]);
        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $videoDetails = json_decode($body, true);
        }
    }

    // Valores por defecto para los atributos
    $autoplay = $data->autoplay ?? false;
    $loop = $data->loop ?? false;
    $muted = $data->muted ?? false;
    $controls = $data->controls ?? true;
    $playsInline = $data->playsInline ?? true;

    // Usa el poster personalizado si está disponible, de lo contrario usa el poster por defecto
    $posterUrl = $thumbnailUrl ?: $videoDetails['thumbnailUrl'] ?? '';

    // Estilos de borde
    $borderColor = $data->style['border']['color'] ?? 'initial';
    $borderRadius = $data->style['border']['radius'] ?? '0';
    $borderStyle = $data->style['border']['style'] ?? 'solid';
    $borderWidth = $data->style['border']['width'] ?? '1px';
@endphp

<div class="video-block not-prose {{ isset($data->align) ? $data->align : '' }} {{ isset($data->className) ? $data->className : '' }} overflow-hidden"
    style="border-color: {{ $borderColor }}; border-radius: {{ $borderRadius }}; border-style: {{ $borderStyle }}; border-width: {{ $borderWidth }};">
    @if ($videoDetails && !empty($videoDetails['hlsUrl']))
        <div id="video-player-{{ $videoId }}" data-video-id="{{ $videoId }}"
            data-thumbnail-url="{{ $posterUrl }}" data-autoplay="{{ $autoplay ? 'true' : 'false' }}"
            data-loop="{{ $loop ? 'true' : 'false' }}" data-muted="{{ $muted ? 'true' : 'false' }}"
            data-controls="{{ $controls ? 'true' : 'false' }}" data-playsinline="{{ $playsInline ? 'true' : 'false' }}"
            class="w-full"></div>
    @else
        <p>{{ __('No video ID provided or no video resolutions found.', 'sage') }}</p>
    @endif
</div>
