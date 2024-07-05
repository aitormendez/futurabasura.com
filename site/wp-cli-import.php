<?php
// Cargar WordPress
define('WP_USE_THEMES', false);
require_once('/srv/www/futurabasura.com/current/web/wp/wp-load.php' );

// Registrar el filtro para desactivar la verificación SSL
add_filter('http_request_args', function($args) {
    $args['sslverify'] = false;
    return $args;
}, 10, 1);