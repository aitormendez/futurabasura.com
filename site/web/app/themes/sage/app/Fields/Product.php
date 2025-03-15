<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
// use StoutLogic\AcfBuilder\FieldsBuilder;
use Log1x\AcfComposer\Builder;
use App\Fields\Partials\Portada;

class Product extends Field
{
    public function fields()
    {
        $builder = Builder::make('destacar_producto_en_portada');

        $builder
            ->setLocation('post_type', '==', 'product');

        $builder
            ->addPartial(Portada::class)
            ->addColorPicker('single_product_thumbnail_bg_color', [
                'label' => 'Color de fondo para la miniatura',
                'instructions' => 'el color de fondo para la miniatura de la página single product',
                'required' => 0,
                'conditional_logic' => [],
                'enable_opacity' => 0,
                'return_format' => 'string',
                'default_value' => 'rgba(255,255,255,1)',
            ])
            ->addTrueFalse('single_product_thumbnail_shadow', [
                'label' => 'Sombra miniatura móvil',
                'instructions' => 'Añade una sombra a la miniatura por la parte de abajo en dispositivo móvil',
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Sí',
                'ui_off_text' => 'No',
            ])
            ->addText('single_product_alt_name', [
                'label' => 'Nombre alternativo',
                'instructions' => 'Si este campo no está vacío, se usará su contenido para los lugares donde aparece el artista, es decir, en sustitución del artista',
            ]);

        return $builder->build();
    }
}
