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
        //    $left_img = wp_get_attachment_image_src($slider['prv_slider_left_pic_id'], 'full', null, array(
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
            "left_img" => $left_img[0],
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

    <div id="<?php echo $magaza_slider_id . "__ID";  ?>" class="carousel slide mb-5" data-ride="carousel" data-interval="4000">

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
                $html .= '<div class="' . $magaza_slider_id . '__carousel-item-inner">';
                $html .= '<h4 class="' . $magaza_slider_id . '__text-1">' . $value["title"] . '</h4>';
                $html .= '<p class="' . $magaza_slider_id . '__text-2">' . $value["sub_title"] . '</p>';
                $html .= '<p class="' . $magaza_slider_id . '__text-3">' . $value["manifesto"] . '</p>';
                $html .= '<p class="' . $magaza_slider_id . '__desc">' . $value["desc"] . '</p>';
                $html .= empty($value["button_link"]) ? "" : '<a name="" id="" class="btn btn-primary ' . $magaza_slider_id . '__button" href="' . $value["button_link"] . '" role="button">DETAY</a>';
                $html .= "</div></div>";
                echo $html;
                $index = +1;
            }
            ?>
        </div>
    </div>

<?php
    $html = ob_get_clean();
    echo $html;
});


add_action('home_page_slider', function () {

    $magaza_slider_id  = "anasayfa-slider";
    $magaza_slider_css_id  = "home-page-slider";
    $magaza_slider_css_class  = "home-slider";

    $magaza_slider_object = get_page_by_path($magaza_slider_id, "OBJECT", "slider");
    $slider_ID = $magaza_slider_object->ID;
    $sliders = get_post_meta($slider_ID, 'slider_repeat_group', true);

    $carausel_li_element = [];
    $data = [];

    get_post_meta($post_id, 'prv_kitap_arkaplan_renk', 1);


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
            $desc = $slider['prv_slider_desc'];
        }

        if (isset($slider['prv_slider_button'])) {
            $button_link = esc_html($slider['prv_slider_button']);
        }


        if (isset($slider['prv_slider_button_text'])) {
            $button_text = esc_html($slider['prv_slider_button_text']);
        }

        if (isset($slider['prv_slider_left_pic_id'])) {
            $left_img = wp_get_attachment_image_src($slider['prv_slider_left_pic_id'], 'full', null, array(
                'class' => 'thumb',
            ));
        }

        if (isset($slider['prv_slider_main_pic_id'])) {
            $background_img = wp_get_attachment_image_src($slider['prv_slider_main_pic_id'], 'full', null, array(
                'class' => 'thumb',
            ));
        }

        if (isset($slider['prv_slider_background_color'])) {
            $background_color = esc_html($slider['prv_slider_background_color']);
        }

        $single_data =  array(
            "title" => $title,
            "sub_title" => $sub_title,
            "manifesto" => $manifesto,
            "desc" => $desc,
            "button_link" => $button_link,
            "button_text" => $button_text,
            "left_img" => $left_img[0],
            "background_img" => $background_img[0],
            "background_color" => $background_color
        );

        array_push($data, $single_data);
        $active = ($index == 0) ? 'active' : '';
        $li_element = '<li data-target="#' . $magaza_slider_css_id . '" data-slide-to="' . $index . '" class="' . $active . '"></li>';
        array_push($carausel_li_element, $li_element);
        $index  += 1;
    }

    ob_start();
?>
    <div id="<?php echo $magaza_slider_css_id ?>" class="carousel slide h-100" data-ride="carousel" data-interval="7000">

        <ol class="carousel-indicators">
            <?php
            foreach ($carausel_li_element as $value) {
                echo $value;
            }
            ?>
        </ol>

        <div class="carousel-inner h-100" role="listbox">
            <?php
            $index = 0;
            foreach ($data as $value) {
                $active = ($index == 0) ? 'active' : '';
                $show = ($index == 0) ? 'show' : '';
                $html = '<div class="carousel-item ' . $active . ' h-100">';
                $html .= '<div class="' . $magaza_slider_css_class . '__slider-item h-100" style="background-color:' . $value["background_color"] . ';">';
                $html .= '<img class="p-0 position-absolute ' . $magaza_slider_css_class . '__left-image ' . $show . '" style="z-index:2" src="' . $value["background_img"] . '">';
                $html .= '<img class="p-0 position-absolute ' . $magaza_slider_css_class . '__child-draw ' . $show . '" style="z-index:3" src="' . $value["left_img"] . '">';
                $html .= '<div class="position-relative ' . $magaza_slider_css_class . '__right-text-block ' . $show . '" style="z-index:3">';
                $html .= '<div class="pt-5 text-white text-right pr-5">';
                $html .= '<div class="pt-5 mt-5">';
                $html .= '<h1 class="' . $magaza_slider_css_class . '__text-1 pt-5">' . $value["title"] . '</h1>';
                $html .= '<p class="' . $magaza_slider_css_class . '__text-2">' . $value["sub_title"] . '</p>';
                $html .= '<p class="' . $magaza_slider_css_class . '__text-3">' . $value["manifesto"] . '</p>';
                $html .= '</div><div class="' . $magaza_slider_css_class . '__desc text-right w-50 ml-auto ml"><div class="py-3">';
                $html .= '<p class="lead">' . $value["desc"] . '</p>';
                $html .= '</div></div>';
                $html .= empty($value["button_link"]) ? "" : '<a name="" id="" style="" class="btn btn-outline-light btn-lg pl-5 pr-5 ' . $magaza_slider_css_class . '__button" href="' . $value["button_link"] . '" role="button">' . $value["button_text"] . '</a>';
                $html .= '</div></div></div></div>';
                echo $html;
                $index = +1;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#home-page-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#home-page-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<?php
    $html = ob_get_clean();
    echo $html;
});


add_action('cart_html_output', 'App\add_to_cart_template_html');
