<?php $__env->startSection('content'); ?>
<?php while(have_posts()): ?> <?php the_post() ?>

<?php echo $__env->make('sections.section-homepage-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-sorular-konusuyor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-brans-denemeleri', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-teke-tek', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-muhendis-kafasi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-beceri-temelli', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-yorumlar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-neden-sorular-konusuyor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sections.section-benimsorumnet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>