<?php $count = count($slider); ?>

<div class="relative flex justify-center mb-6 bg-white slide-wrapper">
  <div id="fondo-slider" class="absolute w-screen bg-cover sm:w-3/4"></div>
  <div class="w-screen glide sm:w-3/4">
    <div data-glide-el="track" class="glide__track">
      <ul class="glide__slides">
        <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="glide__slide" formato="<?php echo $slide['formato']; ?>">
          <a href="<?php echo $slide['url']; ?>" class="relative block prod">
            <div class="absolute top-0 bottom-0 hidden p-8 uppercase bg-white bg-hover md:block">
              <div class="leading-tight datos">
                <h2 class="mb-4 font-bold tracking-widest text-black"><?php echo $slide['nombre']; ?></h2>
                <p class="mb-4 font-bold tracking-widest text-black"><?php echo $slide['artist']; ?></p>



                <?php if($slide['product_type'] == 'simple'): ?>
                  <?php if($slide['has_format']): ?>
                    <p class="mb-4 font-bold tracking-widest text-black"><?php echo e($slide['format']); ?> cm</p>
                  <?php endif; ?>
                  <?php if($slide['has_sale_prize']): ?>
                    <p class="mb-4 font-bold text-red-600 line-through"><?php echo e($slide['regular_price']); ?> €</p>
                    <p class="mb-4 font-bold tracking-widest text-black"><?php echo e($slide['sale_prize']); ?> €</p>
                    <?php else: ?>
                    <p class="mb-4 font-bold tracking-widest text-black"><?php echo e($slide['regular_price']); ?> €</p>
                  <?php endif; ?>
                <?php elseif($slide['product_type'] == 'variable'): ?>
                  <?php $__currentLoopData = $slide['variaciones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($v['sale_price'] != ''): ?>
                      <p class="font-bold tracking-widest text-black"><?php echo e($v['format']); ?> cm</p>
                      <p class="mb-4 font-bold tracking-widest text-black"><span class="text-red-600 line-through"><?php echo e($v['regular_price']); ?> €</span> <?php echo e($v['sale_price']); ?> €</p>
                    <?php else: ?>
                    <p class="mb-4 font-bold tracking-widest text-black"><?php echo e($v['format']); ?> cm <?php echo e($v['regular_price']); ?> €</p>
                    <?php endif; ?>
                     
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>


                
              </div>
            </div>
            <?php if(array_key_exists('img', $slide)): ?>
              <img class="relative" src="<?php echo $slide['img']['url']; ?>" srcset="<?php echo $slide['srcset']; ?>" sizes="(max-width: 640px) 100vw, 80vw" alt="">
            <?php endif; ?>
          </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

    <div class="glide__arrows d-none d-sm-block" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
        ←
      </button>
      <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
        →
      </button>
    </div>

    <div class="glide__bullets d-none d-sm-block" data-glide-el="controls[nav]">
      <?php for($i = 0; $i < $count; $i++): ?>
        <button class="glide__bullet" data-glide-dir="=<?php echo e($i); ?>">
          <div class="cruz-wrap">
            <div class="cruz">
              <div class="cruz1"></div>
              <div class="cruz2"></div>
              <div class="cruz3"></div>
            </div>
          </div>
        </button>
      <?php endfor; ?>
    </div>

  </div>
</div>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/partials/slider.blade.php ENDPATH**/ ?>