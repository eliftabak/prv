<header>
  <nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand text-uppercase font-weight-bold" href="<?php echo e(home_url('/')); ?>">
      <img
        src="http://localhost:3000/websiteler/pruvaakademi.com/wp-content/themes/prv/resources/assets/images/pruva-akademi-logo.svg"
        alt="<?php echo e(get_bloginfo('name', 'display')); ?>" width="103" height="auto">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <?php if(has_nav_menu('primary_navigation')): ?>
        <?php echo wp_nav_menu( [
        'theme_location' => 'primary_navigation',
        'depth' => 2,
        'container' => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id' => 'bs-example-navbar-collapse-1',
        'menu_class' => 'nav navbar-nav',
        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker()
        ] ); ?>

        <?php endif; ?>
  </nav>
</header>
