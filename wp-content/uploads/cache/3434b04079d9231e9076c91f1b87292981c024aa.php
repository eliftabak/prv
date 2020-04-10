<header>
  <nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand text-uppercase font-weight-bold" href="<?php echo e(home_url('/')); ?>">
      <img src="<?php echo e(home_url('/')); ?>wp-content/themes/prv/resources/assets/images/pruva-akademi-logo.svg"
        alt="<?php echo e(get_bloginfo('name', 'display')); ?>" width="103" height="auto">
    </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler text-white border border-light" type="button" data-toggle="collapse"
      data-target="#collapsibleNavbar">
      MENÜ<span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>
    <!-- Navbar links -->

    <?php if(has_nav_menu('primary_navigation')): ?>
    <?php echo wp_nav_menu( [
    'theme_location' => 'primary_navigation',
    'depth' => 4,
    'container' => 'div',
    'container_class' => 'collapse navbar-collapse',
    'container_id' => 'collapsibleNavbar',
    'menu_class' => 'nav navbar-nav ml-auto mt-2 mt-lg-0 align-items-center',
    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
    'walker' => new App\Core\Custom_Nav_Menu()
    ] ); ?>

    <?php endif; ?>

    <!-- End Navbar links -->

    <?php do_action('cart_html_output'); ?>

    <!--end navbar-right -->
  </nav>
</header>
