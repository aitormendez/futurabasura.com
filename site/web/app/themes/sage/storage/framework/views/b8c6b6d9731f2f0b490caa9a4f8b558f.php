  <?php $__env->startSection('content'); ?>
    <main id="main" class="py-8 sm:mt-40 main">
      <?php while(have_posts()): ?> <?php (the_post()); ?>
        <?php echo $__env->make('partials.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="max-w-3xl mx-auto tracking-wide bg-white">
          <div class="font-serif prose"><?php (the_content()); ?></div>
        </div>
        
      <?php endwhile; ?>
    </main>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/page-contact.blade.php ENDPATH**/ ?>