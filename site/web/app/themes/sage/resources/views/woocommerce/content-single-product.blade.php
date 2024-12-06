@php
    /**
     * The template for displaying product content in the single-product.php template
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.6.0
     */

    defined('ABSPATH') || exit();

    global $product;

    /**
     * Hook: woocommerce_before_single_product.
     *
     * @hooked woocommerce_output_all_notices - 10
     */
    do_action('woocommerce_before_single_product');
@endphp

@if (post_password_required())
    {!! get_the_password_form() !!}
    @php return; @endphp
@endif

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('flex flex-wrap', $product); ?>>

    @php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action('woocommerce_before_single_product_summary');
    @endphp

    <div
        class="order-1 flex w-full flex-col items-center bg-white px-6 pb-20 pt-6 text-xl md:-order-none md:border-b-2 md:pt-14">
        <h2 class="artista font-bugrino text-center text-xl uppercase tracking-wider md:text-3xl">
            {{ $alt_name ?: $artista['artista']->name }}
        </h2>
        <h1 class="product_title entry-title md:text-md font-fk my-6 text-center text-[1rem] uppercase tracking-wider">
            {!! get_the_title() !!}</h1>

        <div class="excerpt md:text-md font-fk max-w-screen-md text-center text-[1rem] leading-snug">
            {!! $post->post_excerpt !!}
        </div>
    </div>

    <div class="relative order-2 flex w-full items-center justify-center p-6 pt-14 md:order-none md:w-1/2 md:pt-6"
        style="background-color: {{ get_field('single_product_thumbnail_bg_color') ?: '#ffffff' }}">
        <div class="absolute left-6 top-6 w-full uppercase">{{ $product->get_attribute('Product Type') }}</div>
        @if (has_post_thumbnail($post->ID))
            @php
                $thumbnail_id = get_post_thumbnail_id($post->ID);
                $image_metadata = wp_get_attachment_metadata($thumbnail_id);
                $is_horizontal = $image_metadata['width'] > $image_metadata['height'];

                // Obtener el término 'uncategorized' para obtener su ID
                $uncategorized_term = get_term_by('slug', 'uncategorized', 'product_cat');
                $uncategorized_term_id = $uncategorized_term ? $uncategorized_term->term_id : 0;

                // Obtener las categorías del producto actual, excluyendo 'uncategorized'
                $product_categories = wp_get_post_terms(get_the_ID(), 'product_cat', [
                    'exclude' => [$uncategorized_term_id],
                ]);
            @endphp

            <div class="product-featured-image {{ $is_horizontal ? 'w-[55%]' : 'w-1/3' }}">
                @if (!empty($product_categories) && !is_wp_error($product_categories))
                    <ul class="font-fk absolute left-0 top-0 p-6 text-sm uppercase tracking-wider">
                        @foreach ($product_categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>

                @endif

                <img src="{{ get_the_post_thumbnail_url($post->ID, 'large') }}" alt="{{ get_the_title($post->ID) }}">
            </div>
        @endif
    </div>

    <div class="glide-wrap w-full md:w-1/2">
        <div id="glide" class="g-gallery relative">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach ($galeria as $item)
                        <li class="glide__slide slide">
                            <img src="{!! $item['att_url'] !!}" srcset="{!! $item['att_srcset'] !!}"
                                @if ($item['has_alt']) alt="{!! $item['alt'][0] !!}" @endif
                                sizes="(max-width: 792px) 100%, 50%">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="indice" class="absolute bottom-0 right-0 w-20 bg-white p-3 text-center"></div>
        </div>
    </div>

    @if ($product->is_type('simple'))
        <div class="text-azul w-full border-t-2 border-black bg-white p-3 text-center">
            Select product attributes to know the price
        </div>
    @endif


    <div class="order-3 flex w-full md:order-none">
        @php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5 REMOVED
             * @hooked woocommerce_template_single_rating - 10 REMOVED
             * @hooked woocommerce_template_single_price - 10 REMOVED
             * @hooked woocommerce_template_single_excerpt - 20 REMOVED
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40 REMOVED
             * @hooked woocommerce_template_single_sharing - 50 REMOVED
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action('woocommerce_single_product_summary');
        @endphp


    </div>

    @php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action('woocommerce_after_single_product_summary');
    @endphp
</div>

@php do_action( 'woocommerce_after_single_product' ); @endphp
