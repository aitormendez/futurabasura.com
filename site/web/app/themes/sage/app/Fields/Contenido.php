<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Portada;

class Contenido extends Field
{
    public function fields()
    {
        $builder = new FieldsBuilder('destacar_contenido');

        $builder
            ->setLocation('post_type', '==', 'story')
                ->or('post_type', '==', 'project');

        $builder
            ->addTab('Portada', ['placement' => 'left'])
                ->addFields($this->get(Portada::class))
            ;

        return $builder->build();
    }
}
