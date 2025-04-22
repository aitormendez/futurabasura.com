@if (is_post_type_archive('story'))
    <div class="page-header p-6 md:fixed md:py-0">
        <h1 class="page-header-font leading-none">News</h1>
    </div>
@elseif(is_post_type_archive('project'))
    <div class="page-header p-6 md:fixed md:py-0">
        <h1 class="page-header-font leading-none">Projects</h1>
    </div>
@else
    <div class="page-header p-6">
        <h1 class="page-header-font">{!! $title !!}</h1>
    </div>
@endif
