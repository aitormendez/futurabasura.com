<?php $__env->startSection('content'); ?>
    <?php while(have_posts()): ?>
        <?php (the_post()); ?>
        <?php echo $__env->make('partials.content-page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endwhile; ?>

    <?php echo $__env->make('partials.cupones', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->make('partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($destacados['has_posts'] = true): ?>
        <section id="destacados">
            <?php $__currentLoopData = $destacados['posts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destacado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.destacados-portada', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('sections.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/front-page.blade.php ENDPATH**/ ?>