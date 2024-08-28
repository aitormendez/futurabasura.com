@dump($data)
{{-- 
@php
    $post_id = $data->postId;
    $layout = $data->layout ?? 'layout1';
    $post_type = $data->contentType ?? 'product';

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
        $description =
            $post_type === 'product' ? $post->get_description() : apply_filters('the_content', $post->post_content);
        $price = $post_type === 'product' ? $post->get_price() : null;
        $artists_terms = wp_get_post_terms($post_id, 'artist');

        $image_orientation = '';
        if ($image_meta['width'] > $image_meta['height']) {
            $image_orientation = 'horizontal';
        } elseif ($image_meta['width'] < $image_meta['height']) {
            $image_orientation = 'vertical';
        }
    }
@endphp

@if ($layout === 'layout1')
    @if (isset($post))
        <div class="product-block flex aspect-[50/60] w-full !max-w-none md:aspect-[100/50]">
            <div class="col-left w-[10%] border-r-2 border-black md:w-[30%]"
                style="background-color: {{ $data->backgroundColor ?? '#ffffff' }}"></div>

            <a href="{{ get_permalink($post_id) }}"
                class="col-center filtro-azul flex w-[80%] flex-col justify-between md:w-[40%]">
                <div class="flex h-full items-center justify-center">
                    <img src="{{ $image_url }}" srcset="{{ $image_srcset }}" sizes="(max-width: 768px) 80%, 50%"
                        alt="{{ $name }}" class="{{ $image_orientation === 'horizontal' ? 'w-full' : 'w-2/3' }}">
                </div>

                @if (!empty($artists_terms) && !is_wp_error($artists_terms))
                    <div class="mx-4 mb-3 grow-0 font-arialblack text-sm text-black md:text-base">
                        <span>{{ $name }} by </span>
                        @foreach ($artists_terms as $term)
                            <span>{{ $term->name }}</span>
                        @endforeach
                    </div> <!-- Cerrar el div correspondiente al bloque de términos -->
                @endif
            </a> <!-- Cerrar la etiqueta <a> correctamente -->

            <div class="col-right w-[10%] border-l-2 border-black md:w-[30%]"
                style="background-color: {{ $data->backgroundColor ?? '#ffffff' }}"></div>
        </div>
    @else
        <p>Post not found.</p>
    @endif
@elseif($layout === 'layout2')
    <div class="product-blockflex w-full max-w-none">
        Renderiza el layout 2
    </div>
@endif --}}
