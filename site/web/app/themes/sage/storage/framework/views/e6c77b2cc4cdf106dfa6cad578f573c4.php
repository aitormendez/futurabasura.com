<?php if(is_post_type_archive('story')): ?>
  <div class="p-6 md:fixed page-header md:py-0">
    <h1 class="leading-none page-header-font">News</h1>
  </div>
<?php elseif(is_post_type_archive('project')): ?>
<div class="p-6 md:fixed page-header md:py-0">
  <h1 class="leading-none page-header-font">Projects</h1>
</div>
<?php else: ?>
  <div class="p-6 page-header">
    <h1 class="page-header-font"><?php echo $title; ?></h1>
  </div>
<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/partials/page-header.blade.php ENDPATH**/ ?>