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
            ]);

        return $builder->build();
    }
}
