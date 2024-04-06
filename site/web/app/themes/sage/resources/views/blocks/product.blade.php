<div class="product-block">
    @php
        $product_id = $data->productId;
        $product = wc_get_product($product_id);

        if ($product) {
            $name = $product->get_name();
            $image_id = $product->get_image_id();
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $description = $product->get_description();
            $price = $product->get_price();
            $author_id = get_post_field('post_author', $product_id);
            $artists_terms = wp_get_post_terms($product_id, 'artist');
        }
        $layout = $data->layout; 
    @endphp

    @if($layout === 'layout1')
        @if(isset($product))
            <h2>{{ $name }}</h2>
            <img src="{{ $image_url }}" alt="{{ $name }}">
            <div>{{ $description }}</div>
            <div>Price: {{ $price }}</div>
            @if(!empty($artists_terms) && !is_wp_error($artists_terms))
                @foreach($artists_terms as $term)
                    <span>{{ $term->name }}</span>
                @endforeach
            @endif
        @else
            <p>Product not found.</p>
        @endif
    @elseif($layout === 'layout2')
        Renderiza el layout 2
    @endif
</div>

