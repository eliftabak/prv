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

// Filter except length to 35 words.
// tn custom excerpt length

add_filter('excerpt_length', function ($length) {
    return 20;
}, 999);



/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip;';
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
        'width' => 280,
        'height' => 0,
        'crop' => 0,
    );
});

add_filter('woocommerce_get_image_size_single', function ($size) {
    return array(
        'width' => 836,
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
        add_action('woocommerce_before_single_product_summary', function () {
            echo \App\pdf_modal_html();
        }, 24);
        add_action('woocommerce_before_single_product_summary', __NAMESPACE__ . '\view_container_html', 25);
        add_action('woocommerce_single_product_summary', __NAMESPACE__ . '\woocommerce_the_content_with_wrapper', 6);
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
add_filter('woocommerce_add_to_cart_fragments', __NAMESPACE__ . '\cart_fragment_logic');







/**
 *
 * Add user type column in admin users page
 *
 */
add_filter('manage_users_columns', function ($column) {
    $column['user_type'] = 'Kullanıcı Tipi';
    return $column;
});


add_filter('manage_users_custom_column', function ($val, $column_name, $user_id) {
    switch ($column_name) {
        case 'user_type':
            return get_the_author_meta('prv_user_type', $user_id);
        default:
    }
    return $val;
}, 10, 3);


/**
 *
 * Add sortable column in admin users page
 *
 */

add_filter('manage_users_sortable_columns', function ($columns) {
    $columns['user_type'] = 'prv_user_type';
    return $columns;
});


add_action('pre_get_users', function ($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ('prv_user_type' === $query->get('orderby')) {
        $query->set('orderby', 'meta_value');
        $query->set('meta_key', 'prv_user_type');
    }
});


/**
 *
 * Add user validate column in admin users page
 *
 */
add_filter('manage_users_columns', function ($column) {
    $column['user_validate'] = 'Kullanıcı Onayı';
    return $column;
});


add_filter('manage_users_custom_column', function ($val, $column_name, $user_id) {
    switch ($column_name) {
        case 'user_validate':
            return get_the_author_meta('prv_user_validate', $user_id);
        default:
    }
    return $val;
}, 10, 3);


/**
 *
 * Add sortable column in admin users page
 *
 */

add_filter('manage_users_sortable_columns', function ($columns) {
    $columns['user_validate'] = 'prv_user_validate';
    return $columns;
});


add_action('pre_get_users', function ($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ('prv_user_type' === $query->get('orderby')) {
        $query->set('orderby', 'meta_value');
        $query->set('meta_key', 'prv_user_validate');
    }
});






add_action('woocommerce_product_options_general_product_data', function () {
    woocommerce_wp_checkbox(array(
        'id' => 'product_coming_soon',
        'class' => '',
        'label' => 'Yakında'
    ));
});



add_action('save_post', function ($product_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (isset($_POST['product_coming_soon'])) {
        update_post_meta($product_id, 'product_coming_soon', $_POST['product_coming_soon']);
    } else delete_post_meta($product_id, 'product_coming_soon');
});



add_action('woocommerce_before_shop_loop_item_title', function () {
    global $product;
    $product_id = $product->get_id();
    $home = home_url();
    $product_coming_soon_status = get_post_meta($product_id, 'product_coming_soon', true);
    if ($product_coming_soon_status) {
        echo '<img class ="product-coming-soon product-coming-soon__archive-product lazy" data-src="' . $home . '/wp-content/themes/prv/resources/assets/images/yakinda.png" alt="">';
    } else {
        return;
    }
}, 25);




add_action('woocommerce_product_thumbnails', function () {
    global $product;
    $product_id = $product->get_id();
    $home = home_url();
    $product_coming_soon_status = get_post_meta($product_id, 'product_coming_soon', true);
    if ($product_coming_soon_status) {
        echo '<img class ="product-coming-soon product-coming-soon__single-product lazy" data-src="' . $home . '/wp-content/themes/prv/resources/assets/images/yakinda.png" alt="">';
    } else {
        return;
    }
}, 10, 0);



add_filter('woocommerce_product_add_to_cart_text', function () {
    global  $product;
    $text = $product->is_purchasable() && $product->is_in_stock() ? __('Add to cart', 'woocommerce') : __('İncele', 'woocommerce');
    return $text;
});


/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */

add_filter('get_search_form', function ($form) {
    $form  = '<form role="search" method="get" id="searchform" class="searchform input-group input-group-lg" action="' . home_url('/') . '" >';
    $form .= '<label class="screen-reader-text" for="s">' . __('Search for:') . '</label>';
    $form .= '<input type="text" class="form-control form-control-lg" value="' . get_search_query() . '" name="s" id="s" />';
    $form .=  '<div class="input-group-append">';
    $form .= '<button type="submit" id="searchsubmit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>';
    $form .=  '</div>';
    $form .= '</form>';
    return $form;
});
