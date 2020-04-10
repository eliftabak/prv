<?php

namespace App;

/**
 * @snippet       Add Content to Empty Cart Page - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=21585
 * @author        Rodolfo Melogli
 * @compatible    WC 2.6.14, WP 4.7.2, PHP 5.5.9
 */

add_action('woocommerce_cart_is_empty', function () {
    echo 'woocommerce_cart_is_empty_hooks';
});

add_action('woocommerce_shop_slider', function () {

    ob_start();
?>

    <div id="carouselId" class="carousel slide mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselId" data-slide-to="0" class="active"></li>
            <li data-target="#carouselId" data-slide-to="1"></li>
            <li data-target="#carouselId" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1086x250.png?text=First+Slide" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1086x250.png?text=Second+Slide" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1086x250.png?text=Third+Slide" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<?php
    $html = ob_get_clean();
    echo $html;
});


add_action('cart_html_output', 'App\add_to_cart_template_html');
add_action('custom_add_to_cart_block', 'woocommerce_template_single_price', 5, 0);
add_action('custom_add_to_cart_block', 'woocommerce_template_single_add_to_cart', 10, 0);
