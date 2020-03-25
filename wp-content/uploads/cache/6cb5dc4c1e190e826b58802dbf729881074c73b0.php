<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12">
      <?php the_content() ?>
    </div>
  </div>
</section>

<?php echo wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav">
  <p>' . __('Pages:', 'sage'), 'after' => '</p>
</nav>']); ?>

