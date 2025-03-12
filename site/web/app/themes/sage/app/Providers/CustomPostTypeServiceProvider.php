<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomPostTypeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        add_action('init', [$this, 'registerPostTypes']);
        add_action('init', [$this, 'registerTaxonomies']);
        add_action('init', [$this, 'registerBlocks']);
        add_action('init', [$this, 'registerBlockCategories']);
        add_action('init', [$this, 'registerBlockPatterns']);
        add_action('admin_menu', [$this, 'modifyAdminMenu']);
    }

    /**
     * Registra los Custom Post Types
     */
    public function registerPostTypes()
    {
        register_post_type('story', [
            'label' => __('Story', 'sage'),
            'public' => true,
            'menu_icon' => 'dashicons-megaphone',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'show_in_rest' => true,
            'labels' => [
                'name' => __('Stories', 'sage'),
                'singular_name' => __('Story', 'sage'),
            ],
        ]);

        register_post_type('project', [
            'label' => __('Project', 'sage'),
            'public' => true,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail', 'excerpt'],
            'has_archive' => true,
            'show_in_rest' => true,
            'labels' => [
                'name' => __('Projects', 'sage'),
                'singular_name' => __('Project', 'sage'),
            ],
        ]);
    }

    /**
     * Registra las taxonomías
     */
    public function registerTaxonomies()
    {
        register_taxonomy('artist', ['product'], [
            'label' => __('Artists', 'sage'),
            'public' => true,
            'hierarchical' => false,
            'show_in_rest' => true,
        ]);
    }

    public function registerBlocks()
    {
        register_block_type('sage/post', [
            'render_callback' => function ($attributes, $content) {
                return view('blocks.post', compact('attributes', 'content'))->render();
            },
        ]);
    }


    /**
     * Registra categorías de bloques personalizadas
     */
    public function registerBlockCategories()
    {
        add_filter('block_categories_all', function ($categories) {
            return array_merge($categories, [
                [
                    'slug'  => 'fb',
                    'title' => __('Futura Basura', 'sage'),
                    'icon'  => 'star-filled',
                ],
            ]);
        });
    }

    /**
     * Registra patrones de bloques
     */
    public function registerBlockPatterns()
    {
        register_block_pattern('sage/video_retro', [
            'title' => __('Video Retro', 'sage'),
            'description' => __('Video estilo retro', 'sage'),
            'categories' => ['all', 'fb'],
            'content' => '<!-- wp:group {"align":"full"} -->
<div class="wp-block-group alignfull">
<!-- wp:sage/video {"videoId":"54055946-fab4-474a-9195-e35272f7e265","align":"full"} /-->
</div>
<!-- /wp:group -->',
        ]);
    }

    /**
     * Modifica el menú de administración para mover elementos a "Herramientas"
     */
    public function modifyAdminMenu()
    {
        remove_menu_page('edit.php?post_type=gutenberg'); // Ejemplo para eliminar un menú no deseado
    }
}
