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
        // 'product' => [
        //     'admin_cols' => [
        //         'artist' => [
        //             'taxonomy' => 'artist'
        //         ],
        //         'slider' => array(
        //             'title' => 'Slider',
        //             'meta_key' => 'mostrar_en_slider',
        //         ),
        //     ],
        // ],
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
            'hierarchical' => false,
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
        'sage/post' => [
            'title' => __('Content Block', 'sage'),
            'description' => __('Show a product, project, or story', 'sage'),
            'keywords' => ['product', 'project', 'story'],
            'post_types' => ['post', 'page', 'project', 'story'],
            'attributes' => [
                'postId' => [
                    'type' => 'number',
                    'default' => 0,
                ],
                'layout' => [
                    'type' => 'string',
                    'default' => 'layout1',
                ],
                'contentType' => [
                    'type' => 'string',
                    'default' => 'product',
                ],
                'backgroundColor' => [
                    'type' => 'string',
                    'default' => '#ffff00',
                ],
                'align' => [
                    'type' => 'string',
                    'default' => '', // Puedes usar '' como valor por defecto para no aplicar ninguna alineación
                ],
            ],
        ],
        'sage/video' => [
            'title' => __('Video', 'sage'),
            'description' => __('Show a video from bunny.net', 'sage'),
            'keywords' => ['video', 'bunny'],
            'post_types' => ['post', 'page', 'artist'],
        ],
        'sage/marquee' => [
            'title' => __('Marquee', 'sage'),
            'description' => __('Marquee text', 'sage'),
            'keywords' => ['marquee'],
            'post_types' => ['post', 'page', 'artist'],
        ],
        'sage/slider' => [
            'title' => __('Slider', 'sage'),
            'description' => __('Slider', 'sage'),
            'keywords' => ['slider'],
            'post_types' => ['post', 'page', 'artist'],
        ],
        'sage/slide' => [
            'title' => __('Slide', 'sage'),
            'description' => __('Slide', 'sage'),
            'keywords' => ['slide'],
            'post_types' => ['post', 'page', 'artist'],
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
            'icon' => 'star-filled',
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
        'sage/video_retro' => [
            'title' => 'Video Retro',
            'description' => 'Video estilo retro',
            'categories' => ['all', 'fb'],
            'content' => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"gris-claro-fb","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull has-gris-claro-fb-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:sage/video {"videoId":"54055946-fab4-474a-9195-e35272f7e265","align":"full","muted":true,"style":{"border":{"color":"","radius":"10px","style":"solid","width":"1px"}}} /--></div>
<!-- /wp:group -->',
        ],
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
        'fb' => [
            'label' => 'Futura Basura',
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
