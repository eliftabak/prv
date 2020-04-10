<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views',
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

function color_converter($hex, $steps)
{
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color = hexdec($color); // Convert to decimal
        $color = max(0, min(255, $color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

function view_container_html()
{

    $post_id = get_the_ID();
    $video_cozum = esc_url(get_post_meta($post_id, "prv_video-cozum_url", 1));

    $html = '<div class="view-container">';
    $html .= '<div class="view-container__element view-container__sample">
              <a href="" data-toggle="modal" data-target="#PDFModal">
              <i class="fa fa-search" aria-hidden="true"></i><h6>Kitabı İncele</h5>
              </a>
              </div>';
    $html .= '<div class="view-container__element view-container__book mt-2">
              <a href="' . $video_cozum . '">
              <i class="fa fa-play" aria-hidden="true"></i><h6>Video Çözümlü</h5>
              </a>
              </div>';
    $html .= '</div>';
    echo $html;
}

function product_background_color_generate()
{

    $post_id = get_the_ID();
    $background_color = get_post_meta($post_id, 'prv_kitap_arkaplan_renk', 1);
    $lighter = color_converter($background_color, 100);
    $darker = color_converter($background_color, -100);
    $image = wp_get_attachment_image_src(get_post_meta($post_id, 'prv_kitap_arkaplan_resim_id', 1), 'full')[0];
    $result = 'url(' . $image . '),linear-gradient(163deg, ' . $lighter . ' -77%, ' . $darker . ' 122%)';
    return $result;
}

function woocommerce_the_content_with_wrapper()
{
    $content = get_the_content();

    $html = '<div class="woocommerce-product-details__full-content mb-2">';
    $html .= '<div>' . $content . '</div>';
    $html .= '</div>';
    $html .= '<hr class="mb-3">';

    echo $html;
}

function pdf_modal_html()
{
    $post_id = get_the_ID();
    $kitab_incele = esc_url(get_post_meta($post_id, 'prv_kitap_inceleme_pdf', 1));
    $html = '<!-- pdf modal start -->
     <div class="modal fade pdf-viewer__modal" id="PDFModal" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog pdf-viewer__modal-dialog" role="document">
         <div class="modal-content shadow-lg">
           <div class="modal-body pdf-viewer__modal-body">
             <button type="button" class="btn btn-light rounded-pill model-close pdf-viewer__model-close" data-dismiss="modal"
               aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
             <!-- 16:9 aspect ratio -->
             <div class="embed-responsive-">
               <iframe class="embed-responsive-item pdf-viewer__iframe"
               src="' . $kitab_incele . '" id="pdf"  frameborder="0">
                </iframe>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- pdf modal end -->';

    echo $html;
}


function add_to_cart_html($args)
{
    $total_count = $args["total_count"];
    $cart_url = $args["cart_ul"];
    $name = $args["name"];
    $total_amount = $args["total_amount"];
    $shop_page_url  = $args["shop_page_url"];
    $items = $args["items"];
    $checkout_url = $args["checkout_url"];


?>
    <div id="Cart" class="cart text-white d-inline">
        <ul class="d-flex m-0 p-0 align-items-center">
            <li class="cart__count"><?php echo $total_count ?></li>
            <li>
                <div class="dropdown">
                    <a class="btn cart__button dropdown-toggle" href="<?php echo $cart_url; ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-shopping-cart cart__icon pr-1"></i><span class="cart__text">SEPET</span>
                        <span class="cart__user text-center"><?php echo $name; ?></span>
                    </a>
                    <div class="dropdown-menu cart__dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="row cart__total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <a href="<?php echo $cart_url; ?>">Sepet | <span><i class="fa fa-shopping-cart cart__detail-shopping-icon" aria-hidden="true"></i>
                                        <span class="badge badge-pill badge-danger cart__detail-shopping-badge"><?php echo $total_count ?></span></span>
                                </a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-6 cart__total-section text-right">
                                <p>Toplam: <span class="text-info"><?php echo $total_amount ?> TL</span></p>
                            </div>
                        </div>
                        <?php
                        if ($total_count == 0) {
                        ?>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center p-5">
                                    <p>Sepetinizde herhangi bir ürün bulunmamaktadır.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center cart__checkout">
                                    <a name="" id="" class="btn btn-primary btn-block" href="<? echo $shop_page_url ?>" role="button">Alışverişe
                                        başla</a>
                                </div>
                            </div>
                            <?php
                        } else {

                            foreach ($items as $item => $values) {
                                $_product = wc_get_product($values['data']->get_id());
                                $getProductDetail = wc_get_product($values['product_id']);
                                $product_url = get_permalink($values['data']->get_id());
                            ?>

                                <div class="row cart__detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart__detail-img">
                                        <a href="<?php echo $product_url ?>">
                                            <?php echo $getProductDetail->get_image("thumbnail") ?>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart__detail-product">
                                        <a href="<?php echo $product_url ?>">
                                            <p> <?php echo $_product->get_title() ?></p>
                                        </a>
                                        <span class="cart__product-price text-info">
                                            <?php echo get_post_meta($values['product_id'], '_regular_price', true) ?> TL
                                        </span>
                                        <span class="count">
                                            <?php echo $values['quantity'] ?>
                                            Adet
                                        </span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center cart__checkout">
                                    <a name="" id="" class="btn btn-success btn-block" href="<?php echo  $checkout_url; ?>" role="button">Ödeme</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </li>
        </ul>
    </div>
<?php

}


function cart_fragment_logic($fragments)
{
    global $current_user;
    wp_get_current_user();
    $items = WC()->cart->get_cart();
    $total_count = WC()->cart->cart_contents_count;
    $total_amount = WC()->cart->total;
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    $cart_url = wc_get_cart_url();
    $checkout_url = wc_get_checkout_url();
    $name = is_user_logged_in()
        ? '<i class="fa fa-user-o cart__user-icon" aria-hidden="true"></i>' . $current_user->first_name[0] . "" . $current_user->last_name[0]
        : '<i class="fa fa-user-o cart__user-icon" style="display: inline-block!important;
    visibility: visible;" aria-hidden="true"></i>';


    $args  = array();
    $args["total_amount"] = $total_amount;
    $args["cart_ul"] = $cart_url;
    $args["name"] = $name;
    $args["total_count"] = $total_count;
    $args["shop_page_url"] = $shop_page_url;
    $args["items"] = $items;
    $args["checkout_url"] =  $checkout_url;

    ob_start();

    add_to_cart_html($args);

    $fragments['#Cart.cart'] = ob_get_clean();
    return $fragments;
};

function add_to_cart_template_html()
{

    global $current_user;
    wp_get_current_user();
    $items = WC()->cart->get_cart();
    $total_count = WC()->cart->cart_contents_count;
    $total_amount = WC()->cart->total;
    $shop_page_url = get_permalink(wc_get_page_id('shop'));
    $cart_url = wc_get_cart_url();
    $checkout_url = wc_get_checkout_url();
    $name = is_user_logged_in()
        ? '<i class="fa fa-user-o cart__user-icon" aria-hidden="true"></i>' . $current_user->first_name[0] . "" . $current_user->last_name[0]
        : '<i class="fa fa-user-o cart__user-icon" style="display: inline-block!important;
    visibility: visible;" aria-hidden="true"></i>';


    $args  = array();
    $args["total_amount"] = $total_amount;
    $args["cart_ul"] = $cart_url;
    $args["name"] = $name;
    $args["total_count"] = $total_count;
    $args["shop_page_url"] = $shop_page_url;
    $args["items"] = $items;
    $args["checkout_url"] =  $checkout_url;

    ob_start();

    add_to_cart_html($args);

    $html = ob_get_clean();
    echo $html;
}
