@php
    $post_id = $data->postId;
    $layout = $data->layout ?? 'layout1';
    $post_type = $data->contentType ?? 'product';
    $align = $data->align ?? '';

    if ($post_type === 'product') {
        $post = wc_get_product($post_id);
    } else {
        $post = get_post($post_id);
    }

    if ($post) {
        $name = $post_type === 'product' ? $post->get_name() : $post->post_title;
        $image_id = $post_type === 'product' ? $post->get_image_id() : get_post_thumbnail_id($post_id);
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        $image_srcset = wp_get_attachment_image_srcset($image_id, 'full');
        $image_meta = wp_get_attachment_metadata($image_id);
        $excerpt = has_excerpt($post_id) ? get_the_excerpt($post_id) : 'El post no tiene excerpt';
        $price = $post_type === 'product' ? $post->get_price() : null;
        $artists_terms = wp_get_post_terms($post_id, 'artist');

        $image_orientation = '';
        if ($image_meta['width'] > $image_meta['height']) {
            $image_orientation = 'horizontal';
        } elseif ($image_meta['width'] < $image_meta['height']) {
            $image_orientation = 'vertical';
        }
    }

    // Convertir el tipo de post en su forma plural
    $post_type_plural = [
        'post' => 'Posts',
        'page' => 'Pages',
        'project' => 'Projects',
        'story' => 'Stories',
        'product' => 'Products',
    ];

    $post_type_label = $post_type_plural[$post_type] ?? ucfirst($post_type) . 's';
@endphp

@if (isset($post))
    @if ($layout === 'layout1')
        <div class="flex aspect-[50/60] w-full !max-w-none md:aspect-[100/50]">
            <div class="col-left w-[10%] border-r-2 border-black md:w-[30%]"
                style="background-color: {{ $data->backgroundColor ?? '#ffffff' }}; border-color: {{ $data->borderColor ?? '#3e2b2f' }}">
            </div>
            <a href="{{ get_permalink($post_id) }}"
                class="col-center filtro-azul flex w-[80%] flex-col justify-between md:w-[40%]"
                style="background-color: {{ $data->backgroundInteriorColor ?? '#ffffff' }}">
                <div class="flex h-full items-center justify-center">
                    <img src="{{ $image_url }}" srcset="{{ $image_srcset }}" sizes="(max-width: 768px) 80%, 50%"
                        alt="{{ $name }}"
                        class="{{ $image_orientation === 'horizontal' ? 'w-full' : 'w-2/3' }}">
                </div>

                @if (!empty($artists_terms) && !is_wp_error($artists_terms))
                    <div class="font-arialblack mx-4 mb-3 grow-0 text-sm text-black md:text-base"
                        style="color: {{ $data->textColor ?? '#ffffff' }}">
                        <span>{{ $name }} by </span>
                        @foreach ($artists_terms as $term)
                            <span>{{ $term->name }}</span>
                        @endforeach
                    </div>
                @else
                    <div class="font-arialblack mx-4 mb-3 grow-0 text-sm text-black md:text-base">
                        <span>{{ $name }}</span>
                    </div>
                @endif
            </a>

            <div class="col-right w-[10%] border-l-2 border-black md:w-[30%]"
                style="background-color: {{ $data->backgroundColor ?? '#ffffff' }}; border-color: {{ $data->borderColor ?? '#3e2b2f' }}">
            </div>
        </div>
    @elseif($layout === 'layout2')
        @if (isset($post))
            <div class="not-prose {{ $align }} mx-6 flex border-y-2 border-black py-4 md:flex-row">
                <div style="background-color: {{ $data->backgroundColor ?? '#ffffff' }}"
                    class="flex w-full flex-col justify-between p-6 md:w-1/2">
                    <div class="font-bugrino font-light">{{ $post_type_label }}</div>
                    <div class="font-arialblack my-6 text-center text-sm">
                        {{ $name }}</div>
                    <div class="font-fk text-center text-sm">
                        {!! $excerpt !!}
                    </div>
                </div>
                <div class="flex h-full w-full items-center justify-center md:w-1/2">
                    <img src="{{ $image_url }}" srcset="{{ $image_srcset }}" sizes="(max-width: 768px) 100%, 50%"
                        alt="{{ $name }}"
                        class="{{ $image_orientation === 'horizontal' ? 'w-full' : 'w-2/3' }}">
                </div>
            </div>
        @endif
    @endif
@else
    <p>Post not found.</p>
@endif
