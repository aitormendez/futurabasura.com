<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'hero_video' => $this->heroVideo(),
        ];
    }

    public function heroVideo()
    {

            $video_ID = get_field('hero_video', 'option');


            return $video_ID;

    }

}
