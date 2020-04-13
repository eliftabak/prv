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


    $magaza_slider_id  = "magaza-slider";
    $magaza_slider_object = get_page_by_path($magaza_slider_id, "OBJECT", "slider");
    $slider_ID = $magaza_slider_object->ID;
    $sliders = get_post_meta($slider_ID, 'slider_repeat_group', true);

    $carausel_li_element = [];
    $data = [];

    $index = 0;
    foreach ((array) $sliders as $key => $slider) {

        $title = $sub_title = $manifesto = $desc = $button_link =  $left_img = $background_img = '';

        if (isset($slider['prv_slider_title'])) {
            $title = esc_html($slider['prv_slider_title']);
        }

        if (isset($slider['prv_slider_sub_title'])) {
            $sub_title = esc_html($slider['prv_slider_sub_title']);
        }

        if (isset($slider['prv_slider_manifesto'])) {
            $manifesto = esc_html($slider['prv_slider_manifesto']);
        }


        if (isset($slider['prv_slider_desc'])) {
            $desc = esc_html($slider['prv_slider_desc']);
        }

        if (isset($slider['prv_slider_button'])) {
            $button_link = esc_html($slider['prv_slider_button']);
        }

        //if (isset($slider['prv_slider_left_pic_id'])) {
        //    $left_img = wp_get_attachment_image($slider['prv_slider_left_pic_id'], 'full', null, array(
        //        'class' => 'thumb',
        //    ));
        //}

        if (isset($slider['prv_slider_main_pic_id'])) {
            $background_img = wp_get_attachment_image_src($slider['prv_slider_main_pic_id'], 'full', null, array(
                'class' => 'thumb',
            ));
        }

        $single_data =  array(
            "title" => $title,
            "sub_title" => $sub_title,
            "manifesto" => $manifesto,
            "desc" => $desc,
            "button_link" => $button_link,
            "left_img" => $left_img,
            "background_img" => $background_img[0],
        );

        array_push($data, $single_data);
        $active = ($index == 0) ? 'active' : '';
        $li_element = '<li data-target="#' . $magaza_slider_id . '__ID" data-slide-to="' . $index . '" class="' . $active . '"></li>';
        array_push($carausel_li_element, $li_element);
        $index  += 1;
    }

    ob_start();
?>

    <div id="<?php echo $magaza_slider_id . "__ID";  ?>" class="carousel slide mb-5" data-ride="carousel">

        <ol class="carousel-indicators">
            <?php
            foreach ($carausel_li_element as $value) {
                echo $value;
            }
            ?>
        </ol>

        <div class="carousel-inner" role="listbox">
            <?php
            $index = 0;
            foreach ($data as $value) {
                $active = ($index == 0) ? 'active' : '';
                $html = "";
                $html .= '<div class="carousel-item ' . $magaza_slider_id . '__carousel-item ' . $active . '" style="background: url(' . $value["background_img"] . ');">';
                $html .= '<h1 class="' . $magaza_slider_id . '__text-1">' . $value["title"] . '</h1>';
                $html .= '<p class="' . $magaza_slider_id . '__text-2">' . $value["sub_title"] . '</p>';
                $html .= '<p class="' . $magaza_slider_id . '__text-3">' . $value["manifesto"] . '</p>';
                $html .= '<p class="' . $magaza_slider_id . '__desc">' . $value["desc"] . '</p>';
                $html .= empty($value["button_link"]) ? "" : '<a name="" id="" class="btn btn-primary ' . $magaza_slider_id . '__button" href="' . $value["button_link"] . '" role="button">DETAY</a>';
                $html .= "</div>";
                echo $html;
                $index = +1;
            }
            ?>
        </div>

        <a class="carousel-control-prev" href="#<?php echo $magaza_slider_id . "__ID";  ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#<?php echo $magaza_slider_id . "__ID";  ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<?php
    $html = ob_get_clean();
    echo $html;
});


add_action('cart_html_output', 'App\add_to_cart_template_html');
