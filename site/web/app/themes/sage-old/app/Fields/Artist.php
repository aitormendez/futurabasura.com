<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Artist extends Field
{
    public function fields()
    {
        $artist = new FieldsBuilder('artists');

        $artist
            ->setLocation('taxonomy', '==', 'artist');

        $artist
            ->addImage('artist_avatar', [
                'label' => 'Foto del artista',
                'instructions' => 'Esta imagen aparece en la portada de artistas, donde están todos juntos. Debe tener un formato 1500 px x 1500 px',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '1500',
                'min_height' => '1500',
                'min_size' => '',
                'max_width' => '1500',
                'max_height' => '1500',
                'max_size' => '',
                'mime_types' => '',
            ])
            ->addImage('artist_hero', [
                'label' => 'Foto del artista para hero header',
                'instructions' => 'Esta imagen aparece en la cabecera de la página individual de artista. Debe tener un formato 2000 px x 800 px',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '2000',
                'min_height' => '800',
                'min_size' => '',
                'max_width' => '2000',
                'max_height' => '800',
                'max_size' => '',
                'mime_types' => '',
            ]);

        return $artist->build();
    }
}
