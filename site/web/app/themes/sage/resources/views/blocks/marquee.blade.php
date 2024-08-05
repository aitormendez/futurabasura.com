@dump($data)
<div class="marquee p-4 {{ isset($data->align) ? $data->align : '' }}" 
    data-text="{{ isset($data->marqueeText) ? $data->marqueeText : 'Test text' }}" 
    data-pill-background-color="{{ isset($data->pillBackgroundColor) ? $data->pillBackgroundColor : '#fff' }}"
    data-text-color="{{ isset($data->textColor) ? $data->textColor : '#000' }}"
    style="background-color: {{ isset($data->backgroundColor) ? $data->backgroundColor : '#000' }};">
</div>