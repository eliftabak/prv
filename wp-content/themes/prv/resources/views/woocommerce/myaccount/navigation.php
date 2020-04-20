<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
  exit;
}

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation" role="navigation">
  <?php
  global $wp;
  $current_url = esc_url(home_url($wp->request) . "/");
  ?>
  <div class="list-group list-group-flush">
    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
      <?php
      $url = esc_url(wc_get_account_endpoint_url($endpoint));
      $active = ($url == $current_url ?  "active" : "");
      ?>
      <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="list-group-item list-group-item-action <?php echo $active ?>"><?php echo esc_html($label); ?></a>
    <?php endforeach; ?>
  </div>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>
