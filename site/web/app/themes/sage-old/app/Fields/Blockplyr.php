<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Blockplyr extends Field
{
    public function fields()
    {
        $builder = new FieldsBuilder('block_video_plyr');

        $builder
            ->setLocation('block', '==', 'acf/vimeo');
        
        $builder
            ->addRadio('video_provider', [
                'label' => __('Video provider', 'sage'),
                'required' => 1,
                'choices' => [
                    'vimeo' => 'vimeo',
                    'youtube' => 'youtube',
                ],
                'other_choice' => 0,
                'save_other_choice' => 0,
                'layout' => 'vertical',
                'return_format' => 'value',
            ])
            ->addText('video_id', [
                'label' => 'Video ID',
                'instructions' => 'Especifica el ID del vídeo en Vimeo o YouTube. Por ej. 152570988 o QUTKA47y6ig',
                'placeholder' => '152570988',
            ]);

        return $builder->build();
    }
}



