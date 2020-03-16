<?php $__env->startSection('content'); ?>
<?php while(have_posts()): ?> <?php the_post() ?>
<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- section-1__wrapper start -->
<section class="section-1__wrapper">
  <div class="bg-primary p-0 section-1__container">
    <div class="slider-wrapper">
      <img class="p-0 position-absolute green-background" style="z-index:2"
        src="wp-content/themes/prv/resources/assets/images/green.svg">
      <img class="p-0 position-absolute child" style="z-index:3"
        src="wp-content/themes/prv/resources/assets/images/child.svg">
      <div class="position-relative" style="z-index:3">
        <div class="pt-5 text-white text-right pr-5">
          <div class="pt-5 mt-5">
            <h1 class="text-1 pt-5">Siz hiç konuşan soru bankası</h1>
            <p class="text-2">Gördünüz mü ?</p>
            <p class="text-3">yeni sisteme hazır olun!</p>
          </div>
          <div class="description text-right w-50 ml-auto ml">
            <div class="py-3">
              <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing
                </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim
                corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex
                modi illum quas nam distinctio.</p>
            </div>
          </div>
          <button class="btn btn-purple btn-lg pl-5 pr-5">DETAY</button>
        </div>
      </div>
    </div>
  </div>

  <section class="section-2__wrapper p-0">

  </section>
  <!-- section-2__wrapper end -->

</section>
<!-- section-1__wrapper end -->

<section class="section-3__wrapper p-0">

</section>

<!-- section-3__wrapper end -->
<?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>