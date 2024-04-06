<div class="product-block">
    @dump($data)
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
            $author = get_the_author_meta('display_name', $author_id);
        }
    @endphp

    @if(isset($product))
        <h2>{{ $name }}</h2>
        <img src="{{ $image_url }}" alt="{{ $name }}">
        <div>{{ $description }}</div>
        <div>Price: {{ $price }}</div>
        <div>Author: {{ $author }}</div>
    @else
        <p>Product not found.</p>
    @endif
</div>
