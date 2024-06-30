<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Añadir la imagen del artista a una columna de la taxonomía en el editor.
 */
add_filter('manage_artist_custom_column', function ($content, $column_name, $term_id) {
    $term = get_term($term_id, 'artist');
    $avatar = get_field('artist_avatar', $term);

    switch ($column_name) {
        case 'artist_avatar':
            if (is_array($avatar)) {
                $content = '<img src="' . $avatar["url"] . '" style="max-width:100px">';
            } else {
                $content = __('This artist has no picture', 'sage');
            }
            break;
        default:
            break;
    }
    return $content;
}, 10, 3);

add_filter('manage_edit-artist_columns', function ($columns) {
    $columns['artist_avatar'] = __('Avatar', 'sage');
    return $columns;
});