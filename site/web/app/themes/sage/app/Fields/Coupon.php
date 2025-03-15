<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Coupon extends Field
{
    public function fields()
    {
        $artist = new FieldsBuilder('coupons');

        $artist
            ->setLocation('post_type', '==', 'shop_coupon');

        $artist
            ->addTrueFalse('mostrar_cupon_en_portada', [
                'label' => 'Mostrar cupón en portada',
                'instructions' => 'Activar para que el cupón aparezca destacado en la portada de la web',
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ]);

        return $artist->build();
    }
}
