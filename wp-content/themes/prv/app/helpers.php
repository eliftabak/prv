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
