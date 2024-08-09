@php
    $product_id = $data->productId;
    $layout = isset($data->layout) ? $data->layout : 'layout1';
    $product = wc_get_product($product_id);

    if ($product) {
        $name = $product->get_name();
        $image_id = $product->get_image_id();
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        $image_srcset = wp_get_attachment_image_srcset($image_id, 'full');
        $image_meta = wp_get_attachment_metadata($image_id);
        $description = $product->get_description();
        $price = $product->get_price();
        $author_id = get_post_field('post_author', $product_id);
        $artists_terms = wp_get_post_terms($product_id, 'artist');

        // Detectar si la imagen es horizontal o vertical
        $image_orientation = '';
        if ($image_meta['width'] > $image_meta['height']) {
            $image_orientation = 'horizontal';
        } elseif ($image_meta['width'] < $image_meta['height']) {
            $image_orientation = 'vertical';
        }
    }
@endphp

@if($layout === 'layout1')
    @if(isset($product))
    <div class="product-block flex w-full !max-w-none aspect-[50/60] md:aspect-[100/50]">
        <div class="col-left w-[10%] md:w-[30%] border-r-2 border-black" style="background-color: {{ $data->backgroundColor ?? '#ffff00' }}"></div>

        <a href="{{ $product->get_permalink() }}" class="col-center w-[80%] md:w-[40%] flex flex-col justify-between filtro-azul">
            <div class="flex justify-center items-center h-full">
                <img 
                    src="{{ $image_url }}" 
                    srcset="{{ $image_srcset }}" 
                    sizes="(max-width: 768px) 80%, 50%" 
                    alt="{{ $name }}" 
                    class="{{ $image_orientation === 'horizontal' ? 'w-full' : 'w-2/3' }}"
                >
            </div>

            @if(!empty($artists_terms) && !is_wp_error($artists_terms))
            <div class="font-arialblack grow-0 mx-4 mb-3 text-black text-sm md:text-base">
                <span>{{ $name }} by </span>
                    @foreach($artists_terms as $term)
                    <span>{{ $term->name }}</span>
                    @endforeach
                @endif
            </div>
        </a>

        <div class="col-right w-[10%] md:w-[30%] border-l-2 border-black" style="background-color: {{ $data->backgroundColor ?? '#ffff00' }}"></div>
    </div>
    @else
        <p>Product not found.</p>
    @endif
@elseif($layout === 'layout2')
    <div class="product-blockflex w-full max-w-none">
        Renderiza el layout 2
    </div>
@endif