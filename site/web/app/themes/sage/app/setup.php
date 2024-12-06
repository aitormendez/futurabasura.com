<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;
use Illuminate\Support\Facades\Log;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    $frases = get_field('frases', 'option');

    if ($frases) {
        $frases_array = [];
        foreach ($frases as $frase) {
            $frases_array[] = $frase['frase'];
        };
    }

    // Ahora que Alpine.js está encolado, puedes localizar tu script
    $terms = get_terms([
        'taxonomy' => 'artist',
        'hide_empty' => false,
    ]);

    $artists = array_map(function ($term) {
        return ['name' => $term->name, 'slug' => $term->slug];
    }, $terms);


    bundle('app')->enqueue()->localize('fb', [
        'fondos' => [
            'f50x70v' => get_field('fondo_50x70v', 'option')['url'],
            'f50x70h' => get_field('fondo_50x70h', 'option')['url'],
            'f61x91v' => get_field('fondo_61x91v', 'option')['url'],
            'f61x91h' => get_field('fondo_61x91h', 'option')['url'],
        ],
        'homeUrl' => get_bloginfo('url'),
        'frases' => $frases_array,
        'artists' => $artists,
    ]);
}, 100);

/*
 * Add frontend styles as editor styles.
 *
 * @return void
 */
// add_action('after_setup_theme', function () {
//     // add app frontend styles as editor styles
//     bundle('app')->editorStyles();

//     // enqueue app editor-only styles, extracted from app frontend styles
//     $relEditorAppOnlyCssPath = asset('editor/app.css')->relativePath(get_theme_file_path());
//     add_editor_style($relEditorAppOnlyCssPath);
// });

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'social_navigation' => __('Social Navigation', 'sage'),
        'shop_navigation' => __('Shop Navigation', 'sage'),
        'contents_navigation' => __('Contents Navigation', 'sage'),
        'footer_pages_navigation' => __('Footer Pages Navigation', 'sage'),
        'legal_navigation' => __('Legal Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});





add_action('after_setup_theme', function () {
    // Add frontend styles as editor styles
    // Must be added by relative path (not remote URI)
    // (@see https://core.trac.wordpress.org/ticket/55728#ticket)
    $relCssPath = asset('app.css')->relativePath(get_theme_file_path());
    add_editor_style($relCssPath);
});


/**
 * Desactivar la librería de fuentes.
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/filters/editor-filters/#disable-the-font-library
 */
// add_filter( 'block_editor_settings_all', function ( $settings ) {
//     $settings['fontLibraryEnabled'] = false;
//     return $settings;
// });



/**
 * Esto es para detectar y escribir en el log cuándo se redirige el carrito.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_redirect/
 */

// add_filter('wp_redirect', function ($location, $status) {
//     if (is_cart()) {
//         $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10); // Limita la profundidad de la traza a 10 niveles
//         $trace_log = [];

//         foreach ($backtrace as $trace) {
//             $trace_log[] = (isset($trace['file']) ? $trace['file'] : '[Sin archivo]') . ' en línea ' . (isset($trace['line']) ? $trace['line'] : '[Sin línea]');
//         }

//         Log::warning('Redirección en el carrito a: ' . $location);
//         Log::warning('Traza de la redirección: ' . implode(" -> ", $trace_log));
//     }

//     return $location; // Asegúrate de devolver la URL para que la redirección continúe.
// }, 10, 2);


/**
 * Desactivar la redirección ccanónicaanéis en la página del carrito.
 * Es para poder usar el dev server en la página del carrito
 * 
 * @link https://developer.wordpress.org/reference/functions/redirect_canonical/
 * 
 */
add_filter('redirect_canonical', function ($redirect_url) {
    if (is_cart() || is_checkout()) {
        return false; // Desactiva la redirección canónica en la página del carrito
    }
    return $redirect_url;
});


/**
 * Permitir temporalmente que el servidor de WordPress acepte solicitudes CORS desde localhost:3000
 * Es para poder desarrollar el carrito y checkout
 */
// add_action('init', function () {
//     // Verificar si el encabezado HTTP_ORIGIN está presente
//     $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

//     // Permitir solicitudes desde localhost:3000
//     if ($origin === 'http://localhost:3000') {
//         // Añadir los encabezados CORS necesarios
//         header("Access-Control-Allow-Origin: $origin");
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//         header("Access-Control-Allow-Credentials: true");
//         header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
//     }

//     // Manejar las solicitudes OPTIONS
//     if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//         // Enviar respuesta 200 OK y terminar la ejecución
//         status_header(200);
//         exit();
//     }
// });

/**
 * Enable support for block alignments.
 */
add_action('init', function () {
    $block_registry = \WP_Block_Type_Registry::get_instance();

    // Verificar si el bloque core/shortcode está registrado
    if ($block_registry->is_registered('core/shortcode')) {
        // Obtener el bloque registrado
        $block_type = $block_registry->get_registered('core/shortcode');

        // Añadir soporte de alineación
        if ($block_type) {
            $block_type->supports['align'] = ['wide', 'full'];
        }
    }
});
