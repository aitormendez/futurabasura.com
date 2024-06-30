@if ($hero_video)
<section class="mb-6">
    <div class="plyr__video-embed w-100" id="player" data-muted="{{ get_field('hero_video_autoplay', 'option')  }}">
        <iframe
            src="https://player.vimeo.com/video/{{ $hero_video }}?loop={{ get_field('hero_video_loop', 'option')  }}&amp;muted=true&amp;title=false&amp;gesture=media&amp;autoplay={{ get_field('hero_video_autoplay', 'option')  }}"
            allowfullscreen 
            allowtransparency 
            allow="autoplay">
        </iframe>
    </div>

</section>

@endif