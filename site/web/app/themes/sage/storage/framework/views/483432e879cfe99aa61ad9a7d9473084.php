  <?php $__env->startSection('content'); ?>
    <main id="main" class="py-8 sm:mt-40 main">
      <?php while(have_posts()): ?> <?php (the_post()); ?>
        <?php echo $__env->make('partials.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.content-cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endwhile; ?>
    </main>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/page-cart.blade.php ENDPATH**/ ?>