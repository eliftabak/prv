<header>
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand text-uppercase font-weight-bold" href="<?php echo e(home_url('/')); ?>">
      <?php echo App::logo("navbar"); ?>

    </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler text-white border border-light" type="button" data-toggle="collapse"
      data-target="#collapsibleNavbar">
      MENÜ<span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>
    <!-- Navbar links -->

    <?php
    if (has_nav_menu('primary_navigation')) {
    do_action('primary_nav_menu');
    }?>

    <!-- End Navbar links -->

    <?php do_action('cart_html_output'); ?>

    <!--end navbar-right -->
  </nav>
</header>
