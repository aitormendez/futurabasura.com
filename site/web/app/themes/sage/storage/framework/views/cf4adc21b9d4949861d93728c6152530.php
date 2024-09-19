<div class="contenido prose bg-white prose-fb py-6 md:py-20 text-xl px-6 md:px-none">
  <?php (the_content()); ?>
</div>


<?php if($pagination): ?>
  <nav class="page-nav" aria-label="Page">
    <?php echo $pagination; ?>

  </nav>
<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/partials/content-page.blade.php ENDPATH**/ ?>