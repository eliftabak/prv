<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(!have_posts()): ?>
<div class="alert alert-warning">
  <?php echo e(__('Sorry, no results were found.', 'sage')); ?>

</div>

<?php echo get_search_form(false); ?>

)
<?php echo $__env->make('sections.section-benimsorumnet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('partials.content-search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-benimsorumnet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>