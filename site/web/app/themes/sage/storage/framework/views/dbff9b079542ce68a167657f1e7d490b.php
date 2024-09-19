<?php if(count($cupones) !== 0): ?>
  <section>
    <?php $__currentLoopData = $cupones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="flex justify-center my-6 cupon-wrap bg-allo">
        <div class="inline-flex justify-between w-5/6 cupon sm:w-1/2 md:2/6 lg:3/12 xl:2/12">
          <div class="punteado bg-punteado"></div>
          <div class="flex flex-col justify-center p-3 textos">
            <h3 class="font-bold text-center"><?php echo e($cupon->post_title); ?></h3>
            <div class="text-center excerpt">
              <?php echo e($cupon->post_excerpt); ?>

            </div>
          </div>
          <div class="punteado bg-punteado"></div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </section>
<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/partials/cupones.blade.php ENDPATH**/ ?>