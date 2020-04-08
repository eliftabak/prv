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



    <?php
    $items = WC()->cart->get_cart();
    $total_count = WC()->cart->cart_contents_count;
    $currency_symbol = get_woocommerce_currency_symbol();
    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    $cart_url = wc_get_cart_url();
    $checkout_url = wc_get_checkout_url();
    ?>

    <div id="Cart" class="cart text-white d-inline">
      <ul class="d-flex m-0 p-0 align-items-center">
        <li class="cart__count"><?php echo e($total_count); ?></li>
        <li>
          <div class="dropdown">
            <button class="btn cart__button dropdown-toggle" type="button" id="dropdownMenuButton"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-shopping-cart cart__icon pr-1"></i><span class="cart__text">SEPET</span><span
                class="cart__user bg-secondary text-white text-center"><i class="fa fa-user cart__user-icon"
                  aria-hidden="true"></i>MD</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div class="row cart__total-header-section">
                <div class="col-lg-6 col-sm-6 col-6">
                  <a href="<?php echo e($cart_url); ?>">Sepet | <span><i class="fa fa-shopping-cart cart__detail-shopping-icon"
                        aria-hidden="true"></i><span
                        class="badge badge-pill badge-danger cart__detail-shopping-badge"><?php echo e($total_count); ?></span></span></a>
                </div>
                <div class="col-lg-6 col-sm-6 col-6 cart__total-section text-right">
                  <p>Toplam: <span class="text-info"><?php echo $woocommerce->cart->total; ?> TL</span></p>
                </div>
              </div>

              <?php if($total_count == 0): ?>

              <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center p-5">
                  <p>Sepetinizde herhangi bir ürün bulunmamaktadır.</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center cart__checkout">
                  <a name="" id="" class="btn btn-primary btn-block" href="<?php echo e($shop_page_url); ?>" role="button">Alışverişe
                    başla</a>
                </div>
              </div>
              <?php else: ?>
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php
              $_product = wc_get_product( $values['data']->get_id() );
              $getProductDetail = wc_get_product( $values['product_id'] );
              $product_url = get_permalink( $values['data']->get_id() );
              ?>

              <div class="row cart__detail">
                <div class="col-lg-4 col-sm-4 col-4 cart__detail-img">
                  <a href="<?php echo e($product_url); ?>">
                    <?php echo $getProductDetail->get_image("thumbnail"); ?>

                  </a>
                </div>
                <div class="col-lg-8 col-sm-8 col-8 cart__detail-product">
                  <a href="<?php echo e($product_url); ?>">
                    <p><?php echo $_product->get_title(); ?></p>
                  </a>
                  <span class="cart__product-price text-info">
                    <?php echo get_post_meta($values['product_id'] , '_regular_price', true); ?> TL
                  </span>
                  <span class="count">
                    <?php echo e($values['quantity']); ?>

                    Adet
                  </span>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center cart__checkout">
                  <a name="" id="" class="btn btn-success btn-block" href="<?php echo e($checkout_url); ?>" role="button">Ödeme</a>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </li>
      </ul>
    </div>

    <!--end navbar-right -->
  </nav>
</header>
