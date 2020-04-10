<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {

    if (!is_admin()) {
        $classes[] = "wp-frontend";
    }
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed',
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100);

add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
        // The sidebar will be displayed if any of the following return true
        false,
        // ... more types
    ]);

    return $display;
});

// Tutorial: http://www.skyverge.com/blog/change-woocommerce-return-to-shop-button/

add_filter('woocommerce_return_to_shop_redirect', function () {
    return get_site_url();
    //Can use any page instead, like return '/sample-page/';
});

/**
 *
 *
 * Add Bootstrap form styling to WooCommerce fields
 *
 */

add_filter('woocommerce_form_field_args', function ($args, $key, $value = null) {

    /*********************************************************************************************/
    /** This is not meant to be here, but it serves as a reference
    /** of what is possible to be changed. /**

    $defaults = array(
    'type'              => 'text',
    'label'             => '',
    'description'       => '',
    'placeholder'       => '',
    'maxlength'         => false,
    'required'          => false,
    'id'                => $key,
    'class'             => array(),
    'label_class'       => array(),
    'input_class'       => array(),
    'return'            => false,
    'options'           => array(),
    'custom_attributes' => array(),
    'validate'          => array(),
    'default'           => '',
    );
    /*********************************************************************************************/

    // Start field type switch case

    switch ($args['type']) {

        case "select": /* Targets all select input type elements, except the country and state select input types */
            $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
            $args['input_class'] = array('form-control', 'input-lg'); // Add a class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class'] = array('control-label');
            // $args['custom_attributes'] = array('data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true'); // Add custom data attributes to the form input itself
            break;

        case 'country': /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
            $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
            $args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class'] = array('control-label');
            //$args['custom_attributes'] = array('data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true');
            break;

        case "state": /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
            $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
            $args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class'] = array('control-label');
            //$args['custom_attributes'] = array('data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true');
            break;

        case "password":
        case "text":
        case "email":
        case "tel":
        case "number":
            $args['class'][] = 'form-group';
            //$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
            break;

        case 'textarea':
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
            break;

        case 'checkbox':
            break;

        case 'radio':
            break;

        default:
            $args['class'][] = 'form-group';
            $args['input_class'] = array('form-control', 'input-lg');
            $args['label_class'] = array('control-label');
            break;
    }

    return $args;
}, 10, 3);

// Wordpress Jpeg Quality Filters

add_filter('jpeg_quality', function ($arg) {
    return 100;
});

// SVG Support Upload Support
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

// WooCommerce Picture Size Filters

add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
    return array(
        'width' => 300,
        'height' => 0,
        'crop' => 0,
    );
});

add_filter('woocommerce_get_image_size_single', function ($size) {
    return array(
        'width' => 569,
        'height' => 0,
        'crop' => 0,
    );
});

add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    return array(
        'width' => 150,
        'height' => 0,
        'crop' => 0,
    );
});

/**
 * Change several of the breadcrumb defaults
 */
add_filter('woocommerce_breadcrumb_defaults', function () {
    return array(
        'delimiter' => '<i class="fa fa-chevron-right woocommerce-breadcrumb__seperator-icon" aria-hidden="true"></i>',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
        'wrap_after' => '</nav>',
        'before' => '',
        'after' => '',
        'home' => _x('Home', 'breadcrumb', 'woocommerce'),
    );
});

// WooCommerce Breadcumb Filters

add_action('template_redirect', function () {

    // WooCommerce Shop and Archive Page Filters

    if (is_shop() || is_archive()) {

        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }

    // WooCommerce Product Page Filters

    if (is_product()) {

        remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

        add_action('woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 15);
        add_action('woocommerce_before_single_product_summary', 'woocommerce_output_all_notices', 16);
        add_action('woocommerce_before_single_product_summary', 'App\pdf_modal_html', 24);
        add_action('woocommerce_before_single_product_summary', 'App\view_container_html', 25);
        add_action('woocommerce_single_product_summary', 'App\woocommerce_the_content_with_wrapper', 6);
        add_action('woocommerce_after_add_to_cart_quantity', 'woocommerce_template_single_price', 5);
        add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_add_to_cart', 5);
        add_action('woocommerce_after_main_content', 'woocommerce_output_related_products', 20);
    }
});

// WooCommerce Produckt Quantity Filters

add_action(
    'wp_footer',
    function () {
        // To run this on the single product page
        if (!is_product()) {
            return;
        }

?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $('form.cart').on('click', 'i.cart-qty-plus, i.cart-qty-minus', function() {

                // Get current quantity values
                var qty = $(this).closest('form.cart').find('.qty');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = parseFloat(qty.attr('step'));

                // Change the value if plus or minus
                if ($(this).is('.cart-qty-plus')) {
                    if (max && (max <= val)) {
                        qty.val(max);
                    } else {
                        qty.val(val + step);
                    }
                } else {
                    if (min && (min >= val)) {
                        qty.val(min);
                    } else if (val > 1) {
                        qty.val(val - step);
                    }
                }

            });

        });
    </script>
<?php
    }
);

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'App\cart_fragment_logic');
