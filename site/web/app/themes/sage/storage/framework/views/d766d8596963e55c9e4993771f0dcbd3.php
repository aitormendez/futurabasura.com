<?php
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
    $posterUrl = $thumbnailUrl ?: ($videoDetails['thumbnailUrl'] ?? '');

    // Estilos de borde
    $borderColor = $data->style['border']['color'] ?? 'initial';
    $borderRadius = $data->style['border']['radius'] ?? '0';
    $borderStyle = $data->style['border']['style'] ?? 'solid';
    $borderWidth = $data->style['border']['width'] ?? '1px';
?>

<div class="video-block overflow-hidden <?php echo e(isset($data->align) ? $data->align : ''); ?>" style="border-color: <?php echo e($borderColor); ?>; border-radius: <?php echo e($borderRadius); ?>; border-style: <?php echo e($borderStyle); ?>; border-width: <?php echo e($borderWidth); ?>;">
    <?php if($videoDetails && !empty($videoDetails['hlsUrl'])): ?>
        <div
        id="video-player-<?php echo e($videoId); ?>"
        data-video-id="<?php echo e($videoId); ?>"
        data-thumbnail-url="<?php echo e($posterUrl); ?>"
        data-autoplay="<?php echo e($autoplay ? 'true' : 'false'); ?>"
        data-loop="<?php echo e($loop ? 'true' : 'false'); ?>"
        data-muted="<?php echo e($muted ? 'true' : 'false'); ?>"
        data-controls="<?php echo e($controls ? 'true' : 'false'); ?>"
        data-playsinline="<?php echo e($playsInline ? 'true' : 'false'); ?>"
        class="w-full"
        ></div>
    <?php else: ?>
        <p><?php echo e(__('No video ID provided or no video resolutions found.', 'sage')); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/blocks/video.blade.php ENDPATH**/ ?>