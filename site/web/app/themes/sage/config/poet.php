<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'product' => [
            'admin_cols' => [
                'artist' => [
                    'taxonomy' => 'artist'
                ],
                'slider' => array(
                    'title' => 'Slider',
                    'meta_key' => 'mostrar_en_slider',
                ),
            ],
        ],
        'story' => [
            'enter_title_here' => 'Título de la noticia',
            'menu_icon' => 'dashicons-megaphone',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'show_in_rest' => true,
            'labels' => [
                'singular' => __('Story', 'sage'),
                'plural' => __('Stories', 'sage'),
            ],
            'admin_filters' => [
                'destacada' => array(
                    'title' => 'Destadaca',
                    'meta_key' => 'mostrar_en_portada',
                ),
            ],
            'admin_cols' => [
                'destacada' => array(
                    'title' => 'Destacada',
                    'meta_key' => 'mostrar_en_portada',
                ),
                'formato' => array(
                    'title' => 'Formato',
                    'meta_key' => 'contenido_formato',
                ),
            ],
        ],
        'project' => [
            'enter_title_here' => 'Título del proyecto',
            'menu_icon' => 'dashicons-portfolio',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'show_in_rest' => true,
            'labels' => [
                'singular' => __('Project', 'sage'),
                'plural' => __('Projects', 'sage'),
            ],
            'admin_filters' => [
                'destacada' => array(
                    'title' => 'Destadaca',
                    'meta_key' => 'mostrar_en_portada',
                ),
            ],
            'admin_cols' => [
                'destacada' => array(
                    'title' => 'Destadaca',
                    'meta_key' => 'mostrar_en_portada',
                ),
                'formato' => array(
                    'title' => 'Formato',
                    'meta_key' => 'contenido_formato',
                ),
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'artist' => [
            'links' => ['product'],
            'meta_box' => 'dropdown',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    | Here you may specify the block types to be registered by Poet and
    | rendered using Blade.
    |
    | Blocks are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the block `sage/accordion`, your block view would be located at:
    |   ↪ `views/blocks/accordion.blade.php`
    |
    | Block views have the following variables available:
    |   ↪ $data    – An object containing the block data.
    |   ↪ $content – A string containing the InnerBlocks content.
    |                Returns `null` when empty.
    |
    */

    'block' => [
        // 'sage/accordion',
        'sage/product' => [
            'title' => __('Product', 'sage'),
            'description' => __('Show a product', 'sage'),
            'category' => 'fb',
            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"/></svg>',
            'keywords' => ['product'],
            'post_types' => ['post', 'page'],
            'mode' => 'preview',
            'attributes' => [
                'layout' => [
                    'default' => 'layout1',
                    'type' => 'string',
                ],
                'productId' => [
                    'default' => 0,
                    'type' => 'number',
                ],
            ],
            // 'render_template' => 'views/blocks/product.blade.php',
            // 'enqueue_style' => mix('styles/blocks/mi-bloque.css'),
            // 'enqueue_script' => mix('scripts/blocks/mi-bloque.js'),
        ],    
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block categories to be registered by Poet for use
    | in the editor.
    |
    */

    'block_category' => [
        'fb' => [
            'title' => 'Futura Basura',
            // 'icon' => 'star-filled',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Patterns
    |--------------------------------------------------------------------------
    |
    | Here you may specify block patterns to be registered by Poet for use
    | in the editor.
    |
    | Patterns are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the pattern `sage/hero`, your pattern content would be located at:
    |   ↪ `views/block-patterns/hero.blade.php`
    |
    | See: https://developer.wordpress.org/reference/functions/register_block_pattern/
    */

    'block_pattern' => [
        // 'sage/hero' => [
        //     'title' => 'Page Hero',
        //     'description' => 'Draw attention to the main focus of the page, and highlight key CTAs',
        //     'categories' => ['all'],
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Pattern Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block pattern categories to be registered by Poet for
    | use in the editor.
    |
    */

    'block_pattern_category' => [
        'all' => [
            'label' => 'All Patterns',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Palette
    |--------------------------------------------------------------------------
    |
    | Here you may specify the color palette registered in the Gutenberg
    | editor.
    |
    | A color palette can be passed as an array or by passing the filename of
    | a JSON file containing the palette.
    |
    | If a color is passed a value directly, the slug will automatically be
    | converted to Title Case and used as the color name.
    |
    | If the palette is explicitly set to `true` – Poet will attempt to
    | register the palette using the default `palette.json` filename generated
    | by <https://github.com/roots/palette-webpack-plugin>
    |
    */

    'palette' => [
        // 'red' => '#ff0000',
        // 'blue' => '#0000ff',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    |
    | Here you may specify admin menu item page slugs you would like moved to
    | the Tools menu in an attempt to clean up unwanted core/plugin bloat.
    |
    | Alternatively, you may also explicitly pass `false` to any menu item to
    | remove it entirely.
    |
    */

    'admin_menu' => [
        // 'gutenberg',
    ],

];