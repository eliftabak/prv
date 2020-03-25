<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(!have_posts()): ?>
<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="error__wrapper text-center">
        <img class="error__image" src="<?php echo e(home_url('/')); ?>wp-content/themes/prv/resources/assets/images/404.png" alt="">
        <h1 class="error__title">Aradığınız sayfa bulunamadı</h1>
        <a id="" class="btn btn-primary p-3 pl-5 pr-5 mt-3 rounded-pill" href="<?php echo e(home_url('/')); ?>" target=""
          role="button"><i class="fa fa-home pr-3" aria-hidden="true"></i>Anasayfa</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>