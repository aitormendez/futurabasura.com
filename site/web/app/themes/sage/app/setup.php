<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;
use Detection\MobileDetect;

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

    $artists = array_map(function($term) {
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
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

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
        'info_navigation' => __('Info Navigation', 'sage'),
        'social_navigation' => __('Social Navigation', 'sage'),
        'shop_navigation' => __('Shop Navigation', 'sage'),
        'contents_navigation' => __('Contents Navigation', 'sage'),
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


// add_action('template_redirect', function() {
//     if (!isset($_COOKIE['is_mobile'])) {
//         $detect = new MobileDetect();
//         $isMobile = $detect->isMobile() && !$detect->isTablet();
//         setcookie('is_mobile', $isMobile ? 'true' : 'false', time() + 86400, '/'); // Expira en 1 día
//     }
// });