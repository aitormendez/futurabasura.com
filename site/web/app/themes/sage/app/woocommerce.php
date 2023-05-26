<?php


/**
 * Shortcode con desplegable de artistas.
 *
 * @link https://stackoverflow.com/questions/56120607/make-a-dropdown-for-a-woocommerce-taxonomy-like-product-tags
 */

add_shortcode( 'product_tax_artist_dropdown', function( $atts ) {
    // Attributes
    $atts = shortcode_atts(
        [
        'hide_empty'   => '1', // or '0'
        'show_count'   => '1', // or '0'
        'orderby'      => 'name', // or 'order'
        'taxonomy'     => 'artist',
        ],
        $atts,
        'product_tax_artist_dropdown'
    );

    global $wp_query;

    $taxonomy      = $atts['taxonomy'];
    $taxonomy_name = get_taxonomy( $taxonomy )->labels->singular_name;

    ob_start();

    wp_dropdown_categories( [
        'hide_empty' => $atts['hide_empty'],
        'show_count' => $atts['show_count'],
        'orderby'    => $atts['orderby'],
        'selected'           => isset( $wp_query->query_vars[$taxonomy] ) ? $wp_query->query_vars[$taxonomy] : '',
        'show_option_none'   => sprintf( __( 'Select an %s', 'sage' ), $taxonomy_name ),
        'option_none_value'  => '',
        'value_field'        => 'slug',
        'taxonomy'   => $taxonomy,
        'name'       => $taxonomy,
        'class'      => 'dropdown_'.$taxonomy,
     ] );
    return ob_get_clean();
} );

/**
 * Rodear filtros de la tienda con un div.filtros -- inicio.
 */
add_action( 'woocommerce_before_shop_loop', function() {
    echo '<div class="relative flex flex-wrap justify-center p-6 filtros md:pt-12 md:pb-20">';
}, 20 );


add_action( 'woocommerce_before_shop_loop', function() {
    echo '<form class="fb_artist-ordering woocommerce-ordering">';
    echo do_shortcode('[product_tax_artist_dropdown]');
    echo '</form>';
}, 20 );

/**
 * Rodear filtros de la tienda con un div.filtros -- fin
 */
add_action( 'woocommerce_before_shop_loop', function() {
    echo '</div><div id="desplegable" class="relative"></div>';
}, 30 );


/**
 * pruebas product loop.
 *
 */

 add_filter('woocommerce_shop_loop_item_title', function() {

 });

/**
 * Eliminar estilos WC.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Eliminar "Showing número de products".
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

/**
 * Eliminar "Sale!".
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Eliminar galería de producto.
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

/**
 * Eliminar breadcrumb y wraper divs.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10, 0 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * Eliminar datos de single product summary.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0 );



/**
 * Eliminar funcionalidad (zoom, gallery, lightbox) de single product.
 */
add_action( 'after_setup_theme', function () {
    remove_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}, 20 );



/**
 * Eliminar reviews de single product y additional information tab.
 */
add_filter( 'woocommerce_product_tabs', function ($tabs) {
    unset($tabs['reviews']);
    unset( $tabs['additional_information'] );
    return $tabs;
}, 98 );

/**
 * Añadir clase simple/variable/etc en body de single-product.
 */

add_action( 'template_redirect', 'template_redirect_action' );
function template_redirect_action() {
    if ( ! is_admin() && is_product() ) {
        add_filter( 'body_class', function ( $classes ) {
            global $post;
            $product = wc_get_product( $post->ID );
            $tipo    = $product->get_type();

            return array_merge( $classes, array( $tipo ) );
        } );
    }
}


/**
 * Eliminar ordenar por popularidad.
 * https://www.pixelninja.me/remove-woocommerce-product-sorting-options/
 */

// Customizes the WooCommerce product sorting options
// Available options are: menu_order, rating, date, popularity, price, price-desc

  add_filter( "woocommerce_catalog_orderby", function( $orderby ) {
    unset($orderby["popularity"]);
    return $orderby;
}, 20 );


/**
 * Eliminar reviews de single product y additional information tab.
 */
add_filter( 'woocommerce_after_shipping_calculator', function()  {
    echo '<div class="text-xs">' . get_field('exp_car_totals', 'option') . '</div>';
});


