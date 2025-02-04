<div class="marquee {{ isset($data->align) ? $data->align : '' }} px-12 py-4"
    data-text="{{ isset($data->marqueeText) ? $data->marqueeText : 'Test text' }}"
    data-pill-background-color="{{ isset($data->pillBackgroundColor) ? $data->pillBackgroundColor : '#fff' }}"
    data-text-color="{{ isset($data->textColor) ? $data->textColor : '#000' }}"
    data-speed="{{ isset($data->speed) ? $data->speed : 10 }}"
    data-font-family="{{ isset($data->fontFamily) ? $data->fontFamily : 'Arial, sans-serif' }}"
    data-link-url="{{ isset($data->linkUrl) ? $data->linkUrl : '#' }}"
    style="background-color: {{ isset($data->backgroundColor) ? $data->backgroundColor : '#000' }};">
</div>
