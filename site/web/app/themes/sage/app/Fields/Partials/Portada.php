<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Portada extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $aportada = new FieldsBuilder('destacar_en_portada');

        $aportada
            ->addTrueFalse('mostrar_en_portada', [
                'label' => 'Mostrar en portada',
                'instructions' => 'activar para destacar este contenido en la portada',
                'required' => 0,
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Mostrando',
                'ui_off_text' => 'Sin mostrar',
            ])
            ->addColorPicker('color_de_fondo', [
                'label' => 'Color de fondo',
                'instructions' => '',
                'required' => 0,
                'default_value' => '',
            ])
                ->conditional('mostrar_en_portada', '==', '1')
            ->addColorPicker('color_de_texto', [
                'label' => 'Color de texto',
                'instructions' => '',
                'required' => 0,
                'default_value' => '',
            ])
                ->conditional('mostrar_en_portada', '==', '1')
            ->addRadio('contenido_formato', [
                'label' => 'Formato de contenido',
                'instructions' => 'elige el formato con el que se mostrará el contenido en portada',
                'choices' => [
                    'imagen' => 'Imagen',
                    'imagen_grande' => 'Imagen grande',
                    'galeria' => 'Galeria',
                    'mosaico' => 'Mosaico',
                    'repeticion' => 'Repetición',
                ],
                'allow_null' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ])
                ->conditional('mostrar_en_portada', '==', '1')
            ->addRadio('procedencia_img', [
                'label' => 'Procedencia de la imagen',
                'instructions' => 'Elige si la imagen se obtiene de la imagen destacada en este post o si se sube una imagen nueva',
                'choices' => [
                    'nueva' => 'Subir imagen nueva',
                    'destacada' => 'Usar la imagen destacada',
                ],
                'allow_null' => 0,
                'default_value' => 'nueva',
                'layout' => 'vertical',
                'return_format' => 'value',
            ])
                ->conditional('contenido_formato', '==', 'imagen')
                ->or('contenido_formato', '==', 'repeticion')
            ->addImage('contenido_imagen_portada', [
                'label' => 'Imagen para portada',
                'instructions' => 'Debe tener un ancho de 1500 px y, probablemente, quede mejor un formato cuadrado (1500px de alto)',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '1500',
            ])
                ->conditional('contenido_formato', '==', 'imagen')
                    ->and('procedencia_img', '==', 'nueva')
                ->or('contenido_formato', '==', 'repeticion')
                    ->and('procedencia_img', '==', 'nueva')
            ->addImage('contenido_imagen_grande_portada', [
                'label' => 'Imagen full page para portada',
                'instructions' => 'Debe tener un tamaño de 2000 x 1200 px',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '2000',
                'min_height' => '1200',
                'max_width' => '2000',
                'max_height' => '1200',
            ])
                ->conditional('contenido_formato', '==', 'imagen_grande')
            ->addGallery('contenido_galeria_portada', [
                'label' => 'Galería',
                'instructions' => 'Introduce las imágenes de la galería. 1500 px x 1500 px',
                'return_format' => 'array',
                'min' => '',
                'max' => '',
                'insert' => 'append',
                'library' => 'all',
                'min_width' => '2000',
                'min_height' => '1500',
                'max_width' => '2000',
                'max_height' => '1500',
            ])
                ->conditional('contenido_formato', '==', 'galeria')
            ->addGallery('contenido_mosaico_portada', [
                'label' => 'Galería',
                'instructions' => 'Introduce las cuatro imágenes del mosaico. 1500 px x 1500 px',
                'return_format' => 'array',
                'min' => '4',
                'max' => '4',
                'insert' => 'append',
                'library' => 'all',
                'min_width' => '1500',
                'min_height' => '1500',
                'max_width' => '1500',
                'max_height' => '1500',
            ])
                ->conditional('contenido_formato', '==', 'mosaico')
        ;

        return $aportada;
    }
}
