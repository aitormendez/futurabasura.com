<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WooCustomizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (! class_exists('WooCommerce')) {
            return;
        }

        add_filter('woocommerce_enqueue_styles', '__return_empty_array');

        // Renderizado del producto completo
        add_action('woocommerce_before_shop_loop_item', [$this, 'renderProductCard'], 10);

        /**
         * Rodear filtros de la tienda con un div.filtros -- inicio.
         */
        add_action('woocommerce_before_shop_loop', function () {
            echo '<div class="relative flex flex-wrap justify-center p-6 filtros md:pt-12 md:pb-20">';
        }, 20);

        /**
         * Rodear filtros de la tienda con un div.filtros -- fin
         */
        add_action('woocommerce_before_shop_loop', function () {
            echo '</div><div id="desplegable" class="relative"></div>';
        }, 30);

        /**
         * Añadir clase simple/variable/etc en body de single-product.
         */

        add_action('template_redirect', function () {
            if (!is_admin() && is_product()) {
                add_filter('body_class', function ($classes) {
                    global $post;
                    $product = wc_get_product($post->ID);
                    $tipo = $product->get_type();

                    return array_merge($classes, [$tipo]);
                });
            }
        });

        // desplegable ordenar
        add_action('woocommerce_before_shop_loop', function () { ?>
            <div x-data="dropdownSort()" x-init="init()" class="relative md:min-w-80 text-center">
                <!-- Aplicar @click.away en este nivel asegura que cualquier clic fuera del desplegable cerrará las opciones -->
                <div @click.away="open = false" @click="open = !open" class="cursor-pointer uppercase tracking-[0.2em] w-full">
                    <span class="block px-3 py-2" x-text="selected"></span>
                    <div x-show="open" class="absolute left-0 bg-white z-10 w-full py-6">
                        <ul>
                            <template x-for="option in options" :key="option.value">
                                <li @click="applySort(option.value)" class="p-2 hover:bg-allo cursor-pointer leading-tight uppercase tracking-[0.2em] border-b text-xs first:border-t" x-text="option.text"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
<?php

            // EL SCRIPT ESTÁ EN SHOP.JS (dropdownSort).
        }, 26);

        //desplegable artistas
        add_action('woocommerce_before_shop_loop', function () {
            echo <<<HTML
                <div x-data="dropdownFilter()" x-init="init()">
                    <div class="md:min-w-64">
                        <div @click="open = !open" class="relative cursor-pointer uppercase tracking-[0.2em] text-center">
                            <span class="block px-3 py-2" x-text="selectedName === '' ? 'By artist' : selectedName"></span>
                            <div x-show="open" @click.away="open = false" class="absolute left-0 bg-white z-10 w-full">
                                <ul class="max-h-60 overflow-auto py-6">
                                    <li @click="applyFilter('')" class="p-2 hover:bg-allo cursor-pointer border-y text-xs">All artists</li>
                                    <template x-for="artist in artists" :key="artist.slug">
                                        <li @click="applyFilter(artist.slug, artist.name)" x-text="artist.name" class="p-2 hover:bg-allo cursor-pointer leading-tight border-b text-xs"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            HTML;

            // EL SCRIPT ESTÁ EN SHOP.JS.

            //Si tu función JavaScript está inline, inclúyela aquí. De lo contrario, asegúrate de que está en un archivo JS que se encola correctamente.
            // echo <<<SCRIPT
            // <script>
            //     console.log('woocommerce_before_shop_loop');
            // </script>
            // SCRIPT;
        }, 25);

        add_action('pre_get_posts', function ($query) {
            // Solo modifica la consulta en la tienda o páginas de archivo de productos
            if (
                !is_admin()
                && $query->is_main_query()
                && ($query->is_post_type_archive('product') || $query->is_tax('product_cat'))
                && isset($_GET['artist_filter'])
                && !empty($_GET['artist_filter'])
            ) {
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => 'artist', // Asegúrate que 'artist' es el slug correcto de tu taxonomía
                        'field'    => 'slug',
                        'terms'    => array(sanitize_text_field($_GET['artist_filter'])),
                    ),
                ));
            }
        });

        // desplegable categoría de producto (product_cat)
        add_action('woocommerce_before_shop_loop', function () {
            echo <<<HTML
                <div x-data="dropdownCategory()" x-init="init()">
                    <div class="md:min-w-64">
                        <div @click="open = !open" class="relative cursor-pointer uppercase tracking-[0.2em] text-center">
                            <span class="block px-3 py-2" x-text="selectedCategory === '' ? 'By product' : selectedCategory"></span>
                            <div x-show="open" @click.away="open = false" class="absolute left-0 bg-white z-10 w-full">
                                <ul class="max-h-60 overflow-auto py-6">
                                    <li @click="applyCategoryFilter('')" class="p-2 hover:bg-allo cursor-pointer border-y text-xs">All products</li>
                                    <template x-for="category in categories" :key="category.slug">
                                        <li @click="applyCategoryFilter(category.slug, category.name)" x-text="category.name" class="p-2 hover:bg-allo cursor-pointer leading-tight border-b text-xs"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            HTML;

            // Obtener el término "uncategorized"
            $uncategorized = get_term_by('slug', 'uncategorized', 'product_cat');
            $uncategorized_id = $uncategorized ? $uncategorized->term_id : null;

            // Obtener las categorías excluyendo "uncategorized" si existe
            $categories = get_terms([
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'exclude' => $uncategorized_id ? [$uncategorized_id] : [], // Excluir solo si se encontró el término
            ]);


            $categories_js = array_map(function ($category) {
                return [
                    'slug' => $category->slug,
                    'name' => $category->name,
                ];
            }, $categories);

            echo "<script>
                function dropdownCategory() {
                    return {
                        open: false,
                        selectedCategory: '',
                        categories: " . json_encode($categories_js) . ",
                        applyCategoryFilter(slug, name) {
                            this.selectedCategory = name || 'All categories';
                            const params = new URLSearchParams(window.location.search);
                            if (slug) {
                                params.set('product_cat', slug);
                            } else {
                                params.delete('product_cat');
                            }
                            window.location.search = params.toString();
                        },
                        init() {
                            const params = new URLSearchParams(window.location.search);
                            const selectedSlug = params.get('product_cat');
                            const categoryArray = Object.values(this.categories); // Convertir objeto en array
                            const selectedCategory = categoryArray.find(category => category.slug === selectedSlug);
                            if (selectedCategory) {
                                this.selectedCategory = selectedCategory.name;
                            }
                        }
                    }
                }
            </script>";
        }, 24);
    }

    /**
     * Renderizar toda la tarjeta del producto (card + card-inner + front/back)
     */
    public function renderProductCard()
    {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        echo '<div class="card">';

        // ABRIMOS el <a> aquí, envolviendo todo lo que antes estaba dentro de card-inner
        echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link card-inner !text-black">';

        // Card Front
        echo '<div class="card-front">';
        if (wp_is_mobile()) {
            $this->renderThumbnailMobile();
        } else {
            echo woocommerce_get_product_thumbnail('large');
        }
        echo '</div>'; // End card-front

        // Card Back (desktop) o metadatos móviles
        if (wp_is_mobile()) {
            $this->renderMobileMeta();
        } else {
            $this->renderCardBack();
        }

        echo '</a>'; // CERRAMOS el <a> después de todo el contenido

        echo '</div>'; // End card

        add_filter('post_class', function ($classes, $class, $post_id) {
            if (is_shop() || is_tax('artist')) {
                $classes[] = 'infinite-scroll-item';
            }
            return $classes;
        }, 10, 3);
    }


    /**
     * Renderizar miniatura para móvil.
     */
    public function renderThumbnailMobile()
    {
        $show_shadow = get_field('single_product_thumbnail_shadow');
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');

        if ($thumbnail_url) {
            $width = $thumbnail_url[1];
            $height = $thumbnail_url[2];
            $shadow_class = $show_shadow ? 'shadow-abajo' : '';

            if ($width > $height) {
                echo '<div class="horizontal">' . get_the_post_thumbnail(get_the_ID(), 'large', ['class' => $shadow_class]) . '</div>';
            } else {
                echo '<div class="px-4 overflow-visible relative z-10">' . get_the_post_thumbnail(get_the_ID(), 'large', ['class' => $shadow_class]) . '</div>';
            }
        }
    }

    /**
     * Renderizar la trasera (back) de la tarjeta en desktop.
     */
    public function renderCardBack()
    {
        echo '<div class="card-back bg-white pt-1 flex flex-col justify-between items-center">';
        $this->renderProductType();
        $this->renderArtist();
        $this->renderProductTitle();
        echo '<ul class="w-full mb-4 fk-display">';
        $this->renderProductAttributes();
        echo '</ul>';
        echo '</div>';
    }

    /**
     * Renderizar metadatos en móvil.
     */
    public function renderMobileMeta()
    {
        echo '<div class="bg-white flex flex-col items-center mx-4">';
        $this->renderArtist();
        $this->renderProductTitle();
        $this->renderProductType();
        echo '<ul class="w-full mb-4 fk-display">';
        $this->renderProductAttributes();
        echo '</ul>';
        echo '</div>';
    }

    /**
     * Mostrar nombre de artista.
     */
    private function renderArtist()
    {
        global $product;
        $artist_ids = wp_get_post_terms($product->get_id(), 'artist', ['fields' => 'names']);
        $alt_name = get_field('single_product_alt_name', $product->get_id());
        $artist_display_name = $alt_name ?: join(', ', $artist_ids);

        if (!empty($artist_display_name)) {
            $class = wp_is_mobile()
                ? 'uppercase font-bugrino my-3 tracking-wider text-center text-lg leading-tight'
                : 'uppercase font-bugrino text-[1.2vw] mt-3 tracking-wide text-center max-w-[90%] leading-tight';

            echo '<div class="' . $class . '">' . esc_html($artist_display_name) . '</div>';
        }
    }

    /**
     * Mostrar tipo de producto.
     */
    private function renderProductType()
    {
        global $product;
        $categories = wp_get_post_terms($product->get_id(), 'product_cat', ['fields' => 'all']);
        foreach ($categories as $category) {
            if ($category->slug !== 'uncategorized') {
                $class = wp_is_mobile()
                    ? 'uppercase font-fk text-sm text-center mb-2 w-full tracking-wider text-gris-fb'
                    : 'uppercase font-fk text-[1.1vw] lg:text-[0.9vw] text-center border-b border-x-negro-fb w-full tracking-wider';

                echo '<div class="' . $class . '">' . esc_html($category->name) . '</div>';
                break;
            }
        }
    }

    /**
     * Mostrar título de producto.
     */
    private function renderProductTitle()
    {
        $class = wp_is_mobile()
            ? 'text-sm font-fk leading-tight uppercase text-center px-2 mb-20 items-center tracking-wider'
            : 'font-fk text-[1.1vw] lg:text-[0.9vw] leading-tight uppercase text-center px-2 grow flex items-center tracking-wider';

        echo '<h2 class="' . $class . '">' . get_the_title() . '</h2>';
    }

    /**
     * Mostrar atributos y precios.
     */
    private function renderProductAttributes()
    {
        global $product;

        if ($product->is_type('variable')) {
            $variations = $product->get_available_variations();
            foreach ($variations as $variation) {
                $variation_obj = new \WC_Product_Variation($variation['variation_id']);
                $this->renderAttributeItem($variation_obj);
            }
        } else {
            $this->renderAttributeItem($product);
        }
    }

    /**
     * Helper para renderizar un atributo + precio.
     */
    private function renderAttributeItem($product_obj)
    {
        $attributes_str = '';

        if (method_exists($product_obj, 'get_variation_attributes')) {
            // Variación de producto
            $attributes = $product_obj->get_variation_attributes();

            foreach ($attributes as $attribute_name => $attribute_value) {
                $attribute_name = str_replace('attribute_', '', $attribute_name);
                $term = get_term_by('slug', $attribute_value, $attribute_name);

                $attributes_str .= ($attributes_str ? ', ' : '') . ($term ? esc_html($term->name) : esc_html($attribute_value));
            }
        } else {
            // Producto simple
            $attributes = $product_obj->get_attributes();

            foreach ($attributes as $attribute) {
                if (!$attribute->get_visible() || $attribute->get_variation()) {
                    continue;
                }

                $taxonomy = $attribute->get_name();
                if ($attribute->is_taxonomy()) {
                    $terms = wp_get_post_terms($product_obj->get_id(), $taxonomy, ['fields' => 'names']);
                    $attributes_str .= ($attributes_str ? ', ' : '') . implode(', ', array_map('esc_html', $terms));
                } else {
                    $attributes_str .= ($attributes_str ? ', ' : '') . esc_html($attribute->get_options()[0] ?? '');
                }
            }
        }

        $class = wp_is_mobile()
            ? 'flex uppercase font-fk justify-between border-t border-black px-4 pt-[1px] last:border-b text-sm tracking-wider -mx-4 bg-white'
            : 'flex uppercase font-fk w-full justify-between border-t border-black px-2 pt-[1px] last:border-b text-[1.1vw] lg:text-[0.9vw] tracking-wider';

        echo '<li class="' . $class . '">';
        echo '<span class="grow">' . $attributes_str . '</span>';

        $price = $product_obj->get_regular_price();
        $sale_price = $product_obj->get_sale_price();

        if (!empty($sale_price) && $sale_price < $price) {
            echo '<span class="mr-2"><del>' . wc_price($price) . '</del></span><span class="text-rojo">' . wc_price($sale_price) . '</span>';
        } else {
            echo '<span></span><span>' . wc_price($price) . '</span>';
        }

        echo '</li>';
    }
}
