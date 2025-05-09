{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://woocommerce.com/document/template-structure/
@package WooCommerce\Templates
@version 8.6.0
--}}

@extends('layouts.app')

@section('content')
    @if (is_tax('artist'))
        @if ($artist_hero['has_hero_img'])
            <div id="toggle-button" class="hero flex flex-wrap justify-center bg-white md:cursor-pointer">
                <img src="{!! $artist_hero['hero_img']['url'] !!}" alt="{!! $artist_hero['hero_img']['alt'] !!}" srcset="{!! $artist_hero['hero_srcset'] !!}" sizes="100vw"
                    class="w-full">
                <div class="section collapsible description p-6 font-sans md:w-3/4">
                    {!! $artist_hero['term']->description !!}
                </div>
            </div>
        @endif
    @endif

    @php
        do_action('get_header', 'shop');

        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action('woocommerce_before_main_content');

        /**
         * Hook: woocommerce_shop_loop_header.
         *
         * @since 8.6.0
         *
         * @hooked woocommerce_product_taxonomy_archive_header - 10
         */
        // do_action('woocommerce_shop_loop_header');

    @endphp

    @if (woocommerce_product_loop())
        @php
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action('woocommerce_before_shop_loop');

            woocommerce_product_loop_start();
        @endphp

        @if (wc_get_loop_prop('total'))
            @while (have_posts())
                @php
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                @endphp
            @endwhile
        @endif

        @php
            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        @endphp
    @else
        @php
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        @endphp
    @endif

    @php
        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('woocommerce_after_main_content');

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action('woocommerce_sidebar');

        do_action('get_footer', 'shop');
    @endphp
@endsection
