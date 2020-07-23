<article <?php post_class() ?>>
  <header>
    <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
    <?php echo $__env->make('partials/entry-meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </header>
  <div class="entry-content">
    <?php the_content() ?>
  </div>
  <?php comments_template('/partials/comments.blade.php') ?>
</article>
