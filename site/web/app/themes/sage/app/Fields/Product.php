<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Portada;

class Product extends Field
{
    public function fields()
    {
        $builder = new FieldsBuilder('destacar_producto_en_portada');

        $builder
            ->setLocation('post_type', '==', 'product');

        $builder
                ->addFields($this->get(Portada::class))
            ;

        return $builder->build();
    }
}
