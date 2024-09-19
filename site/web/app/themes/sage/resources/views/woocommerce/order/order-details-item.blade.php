{{-- Order Item Details --}}

@if (apply_filters('woocommerce_order_item_visible', true, $item))

    <div
        class="{{ esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)) }} table-row">

        <div class="woocommerce-table__product-name product-name table-cell border-b-2 border-black bg-white p-4">
            @php
                $is_visible = $product && $product->is_visible();
                $product_permalink = apply_filters(
                    'woocommerce_order_item_permalink',
                    $is_visible ? $product->get_permalink($item) : '',
                    $item,
                    $order,
                );
            @endphp

            {!! wp_kses_post(
                apply_filters(
                    'woocommerce_order_item_name',
                    $product_permalink ? sprintf('<a href="%s">%s</a>', $product_permalink, $item->get_name()) : $item->get_name(),
                    $item,
                    $is_visible,
                ),
            ) !!}

            @php
                $qty = $item->get_quantity();
                $refunded_qty = $order->get_qty_refunded_for_item($item_id);

                if ($refunded_qty) {
                    $qty_display =
                        '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - $refunded_qty * -1) . '</ins>';
                } else {
                    $qty_display = esc_html($qty);
                }
            @endphp

            {!! apply_filters(
                'woocommerce_order_item_quantity_html',
                ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $qty_display) . '</strong>',
                $item,
            ) !!}

            @php do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false); @endphp

            {!! wc_display_item_meta($item) !!}

            @php do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false); @endphp
        </div>

        <div class="woocommerce-table__product-total product-total table-cell border-b-2 border-black bg-white py-4">
            {!! $order->get_formatted_line_subtotal($item) !!}
        </div>

    </div>

    @if ($show_purchase_note && $purchase_note)
        <div
            class="woocommerce-table__product-purchase-note product-purchase-note table-cell border-b-2 border-black p-4">
            <div class="table-cell" style="width: 100%;">
                {!! wpautop(do_shortcode(wp_kses_post($purchase_note))) !!}
            </div>
        </div>
    @endif

@endif
