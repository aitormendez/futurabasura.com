<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Slider extends Field
{
    public function fields()
    {
        $artist = new FieldsBuilder('slider');

        $artist
            ->setLocation('post_type', '==', 'product');

        $artist
            ->addTrueFalse('mostrar_en_slider', [
                'label' => 'Mostrar en slider',
                'instructions' => 'activar para enviar este producto al slider de portada',
                'required' => 0,
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Mostrando',
                'ui_off_text' => 'Sin mostrar',
            ])
            ->addImage('img_producto', [
                'label' => 'Imagen de producto',
                'instructions' => 'Debe ser de 2000px x 1135px, un PNG con fondo transparente y que encaje en el fondo predefinido',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '2000',
                'min_height' => '1135',
                'max_width' => '2000',
                'max_height' => '1135',
                'mime_types' => 'png',
            ])
                ->conditional('mostrar_en_slider', '==', 1)
            ->addRadio('formato', [
                'label' => 'Formato de la obra',
                'instructions' => '',
                'required' => 0,
                'choices' => [
                    '50x70h' => '50 x 70 horizontal',
                    '50x70v' => '50 x 70 vertical',
                    '61x91h' => '61 x 91 horizontal',
                    '61x91v' => '61 x 91 vertical',
                ],
                'allow_null' => 0,
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical',
                'return_format' => 'value',
            ])
            ->conditional('mostrar_en_slider', '==', 1)
            ;


        return $artist->build();
    }
}
