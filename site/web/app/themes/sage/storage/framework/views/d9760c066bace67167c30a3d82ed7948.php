<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if( $related_products ): ?>

	<section class="order-3 w-full mt-40 related products">

    <?php if( $artista['rand_products']): ?>
      <h2 class="m-6 mt-10 font-bold tracking-widest text-center uppercase">By <?php echo e($artista['artista']->name); ?></h2>
      <?php $__currentLoopData = $artista['rand_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h3 class="px-6 py-1 bg-white"><a href="<?php echo e($product['permalink']); ?>"><?php echo e($product['title']); ?> by <?php echo e($artista['artista']->name); ?></a></h3>

        <div id="glide-<?php echo e($product['product_id']); ?>-art" class="glide g-by-artist">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
            <?php $__currentLoopData = $product['product_gallery']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="glide__slide">
              <img class="block" src="<?php echo $img['att_url']; ?>" srcset="<?php echo $img['att_srcset']; ?>" <?php if($img['has_alt']): ?> alt="<?php echo $img['alt'][0]; ?>" <?php endif; ?> sizes="(max-width: 792px) 100%, 20%">
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You may be interested', 'woocommerce' ) );
    ?>

		<?php if( $heading ): ?>
			<h2 class="m-6 mt-40 font-bold tracking-widest text-center uppercase"><?php echo e($heading); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start() ?>
      <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $product_id = $related_product->get_id();
          $product_title = $related_product->get_title();
          $product_permalink = $related_product->get_permalink();
          $post_object = get_post( $product_id );
          $attachment_ids = $related_product->get_gallery_image_ids();
          $artist = get_the_terms($product_id, 'artist');

          $output = array_map( function( $att_id ) {
            $meta = get_post_meta( $att_id );
            $array = [
                'att_url'    => wp_get_attachment_url( $att_id ),
                'att_srcset' => wp_get_attachment_image_srcset( $att_id ),
                'has_alt'    => false,
                'meta'       => $meta,
            ];
            if (array_key_exists('_wp_attachment_image_alt', $meta)) {
                $array['has_alt'] = true;
                $array['alt'] = $meta['_wp_attachment_image_alt'];
            }
            return $array;
          }, $attachment_ids);

        ?>

        <h3 class="px-6 py-1 bg-white"><a href="<?php echo e($product_permalink); ?>"><?php echo e($product_title); ?> by <?php echo e($artist['0']->name); ?></a></h3>
        <div id="glide-<?php echo e($product_id); ?>-rel" class="glide g-related g-related-<?php echo e($product_id); ?>">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
            <?php $__currentLoopData = $output; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="glide__slide">
              <img class="block" src="<?php echo $item['att_url']; ?>" srcset="<?php echo $item['att_srcset']; ?>" <?php if($item['has_alt']): ?> alt="<?php echo $item['alt'][0]; ?>" <?php endif; ?> sizes="(max-width: 792px) 100%, 20%">
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php woocommerce_product_loop_end() ?>

	</section>
<?php endif; ?>

<?php wp_reset_postdata() ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/single-product/related.blade.php ENDPATH**/ ?>