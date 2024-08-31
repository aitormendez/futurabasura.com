<?php 
$bgc = $destacado['fondo'] ?? '' ;
$ct = $destacado['color_texto'] ?? '' ;
?>

<article class="mb-6 <?php echo e($destacado['post_type']); ?> <?php echo e($destacado['formato']); ?>">

  
  <?php if($destacado['formato'] === 'imagen'): ?>
    <a href="<?php echo e($destacado['link']); ?>" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: <?php echo e($bgc); ?>; color: <?php echo e($ct); ?>">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta"><?php echo e($destacado['post_type']); ?></div>
          <h2 class="my-6 text-2xl tracking-widest"><?php echo e($destacado['title']); ?></h2>
        </div>
        <div class="tracking-wide excerpt">
          <?php echo $destacado['excerpt']; ?>

        </div>
      </header>
      <?php if($destacado['has_img']): ?>
        <div class="img">
          <img src="<?php echo $destacado['url']; ?>" srcset="<?php echo $destacado['srcset']; ?>" alt="<?php echo $destacado['alt']; ?>" sizes="(max-width: 768px) 100vw, 40vw">
        </div>
      <?php endif; ?>
    </a>
  <?php endif; ?>

  
  <?php if($destacado['formato'] === 'imagen_grande'): ?>
    <a href="<?php echo e($destacado['link']); ?>" class="flex flex-wrap w-full text-black bg-white md:justify-center md:items-center" style="background-color: <?php echo e($bgc); ?>; color: <?php echo e($ct); ?>">
      <header class="w-full p-6 col-datos md:absolute md:bg-white md:flex md:flex-col md:justify-between md:flex-wrap">
        <div class="w-full font-serif text-lg font-bold capitalize meta"><?php echo e($destacado['post_type']); ?></div>
        <h2 class="w-full mt-12 mb-12 text-2xl tracking-widest text-center md:mt-0"><?php echo e($destacado['title']); ?></h2>
        <div class="self-end tracking-wide text-center excerpt">
          <?php echo $destacado['excerpt']; ?>

        </div>
      </header>
      <?php if($destacado['has_img']): ?>
        <div class="overflow-hidden img md:max-h-screen">
          <img src="<?php echo $destacado['url']; ?>" srcset="<?php echo $destacado['srcset']; ?>" alt="<?php echo $destacado['alt']; ?>" sizes="100vw">
        </div>
      <?php endif; ?>
    </a>
  <?php endif; ?>

  
  <?php if($destacado['formato'] === 'mosaico'): ?>
    <a href="<?php echo e($destacado['link']); ?>" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: <?php echo e($bgc); ?>; color: <?php echo e($ct); ?>">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta"><?php echo e($destacado['post_type']); ?></div>
          <h2 class="my-6 text-2xl tracking-widest"><?php echo e($destacado['title']); ?></h2>
        </div>
        <div class="tracking-wide excerpt">
          <?php echo $destacado['excerpt']; ?>

        </div>
      </header>
      <?php if($destacado['has_msc']): ?>
        <div class="flex flex-wrap items-start msc">
          <?php $__currentLoopData = $destacado['mosaico']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img class="w-2/4" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" sizes="(max-width: 768px) 50vw, 20vw">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </a>
  <?php endif; ?>

  
  <?php if($destacado['formato'] === 'galeria'): ?>
    <a href="<?php echo e($destacado['link']); ?>" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: <?php echo e($bgc); ?>; color: <?php echo e($ct); ?>">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta"><?php echo e($destacado['post_type']); ?></div>
          <h2 class="my-6 text-2xl tracking-widest"><?php echo e($destacado['title']); ?></h2>
        </div>
        <div class="tracking-wide excerpt">
          <?php echo $destacado['excerpt']; ?>

        </div>
      </header>
      <?php if($destacado['has_gal']): ?>

      <div class="contenedor-slider">
        <div class="glide">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

              <?php $__currentLoopData = $destacado['galeria']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="glide__slide">
                <img class="" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" sizes="(max-width: 768px) 100vw, 40vw">
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
          </div>
        </div>
      </div>



      <?php endif; ?>
    </a>
  <?php endif; ?>

  
  <?php if($destacado['formato'] === 'repeticion'): ?>
    <a href="<?php echo e($destacado['link']); ?>" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: <?php echo e($bgc); ?>; color: <?php echo e($ct); ?>">

      <?php if($destacado['has_img']): ?>
        <div class="img">
          <img src="<?php echo $destacado['url']; ?>" srcset="<?php echo $destacado['srcset']; ?>" alt="<?php echo $destacado['alt']; ?>" sizes="(max-width: 768px) 100vw, 40vw">
        </div>
      <?php endif; ?>


      <div class="relative overflow-hidden clip">
        <?php for($a = 0; $a < 6; $a++): ?>
          <div class="relative linea">
            <?php for($i = 0; $i < 10; $i++): ?>
              <span class="inline-block mx-6 text-2xl tracking-widest title-repetido"><?php echo e($destacado['title']); ?></span>
            <?php endfor; ?>
          </div>
        <?php endfor; ?>
        <?php if($destacado['post_type'] === 'Shop'): ?>
          <div class="absolute bottom-0 w-full p-6 font-serif text-center bg-white sm:text-3xl artista-producto">
            By <?php echo $destacado['artist']; ?>

          </div>
        <?php endif; ?>
      </div>

    </a>
  <?php endif; ?>


</article>

<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/partials/destacados-portada.blade.php ENDPATH**/ ?>