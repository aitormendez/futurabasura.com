  <?php $__env->startSection('content'); ?>
    <?php while(have_posts()): ?> <?php (the_post()); ?>
      <?php echo $__env->make('partials.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endwhile; ?>

    <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e($artist['permalink']); ?>" role="article" class="flex flex-wrap mb-6 md:mb-10 justify-startmb-6 article md:flex-nowrap hover:text-white">
        <h2 class="block w-full p-6 font-bold text-center uppercase tracking-max"><?php echo e($artist['name']); ?></h2>

        <div class="flex items-start justify-center avatar f-full">
          <?php if($artist['avatar']): ?>
          <img src="<?php echo e($artist['avatar']['url']); ?>" srcset="<?php echo e($artist['srcset']); ?>" sizes="(max-width: 768px) 100vw, 20vw" alt="<?php echo e($artist['name']); ?>" class="">
          <?php endif; ?>
        </div>

        <div class="flex flex-wrap items-start w-full md:w-auto productos">
          <?php $__currentLoopData = $artist['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $prod['prod_img']; ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </a>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/page-artists.blade.php ENDPATH**/ ?>