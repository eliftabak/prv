<?php

namespace App;

add_action('woocommerce_cart_is_empty', function () {
    echo 'woocommerce_cart_is_empty_hooks';
});

add_action('after_setup_theme', function () {
    show_admin_bar(false);
});


add_action("woocommerce_share", function () {
    echo do_shortcode(' [social_share] ');
});

add_action("related_posts", function ($post) {



    $related = new \WP_Query(
        array(
            'category_in'   => wp_get_post_categories($post->ID),
            'posts_per_page' => 3,
            'post_not_in'   => array($post->ID),
            'orderby'        => 'rand',
        )
    );

    if ($related->have_posts()) {
        while ($related->have_posts()) {
            $related->the_post();
            $related_post = $related->post;
            $html = '<div class="related-posts__item col-lg-4"><a href="' . get_permalink($related->post) . '">';
            $html .= '<h5 class="related-posts__title mt-0">' .  $related_post->post_title . '</h5>';
            $html .= wp_get_attachment_image(get_post_thumbnail_id($related_post->ID), 'medium', null, array(
                'class' => 'related-posts__image',
            ));
            $html .= '</a></div>';
            echo $html;
        }
        wp_reset_postdata();
    }
}, 10, 1);


add_action('primary_nav_menu', function () {

    $primary_nav_menu_html = get_transient('primary_nav_menu_html');

    if (false === $primary_nav_menu_html) {

        ob_start();
        wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'depth' => 4,
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'collapsibleNavbar',
            'menu_class' => 'nav navbar-nav ml-auto mt-2 mt-lg-0 align-items-center',
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new \App\Core\Custom_Nav_Menu()
        ]);

        $html  = ob_get_clean();
        set_transient('primary_nav_menu_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $primary_nav_menu_html = $html;
        echo $primary_nav_menu_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $primary_nav_menu_html;
});

add_action('woocommerce_shop_slider', function () {

    $woocommerce_shop_slider_html = get_transient('woocommerce_shop_slider_html');

    if (false === $woocommerce_shop_slider_html) {


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

        <div id="<?php echo $magaza_slider_id . "__ID";  ?>" class="carousel slide mb-3 mb-lg-5" data-ride="carousel" data-interval="4000">

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
        $html  = ob_get_clean();

        set_transient('woocommerce_shop_slider_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $woocommerce_shop_slider_html = $html;
        echo $woocommerce_shop_slider_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $woocommerce_shop_slider_html;
});


add_action('home_page_slider', function () {

    $home_page_slider_html = get_transient('home_page_slider_html');

    if (false === $home_page_slider_html) {

        $magaza_slider_id  = "anasayfa-slider";
        $magaza_slider_css_id  = "home-page-slider";
        $magaza_slider_css_class  = "home-slider";

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
        <div id="<?php echo $magaza_slider_css_id ?>" class="carousel carousel-lazy slide h-100" data-ride="carousel" data-interval="7000">

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
                    $html .= '<img  class="p-0 position-absolute ' . $magaza_slider_css_class . '__left-image ' . $show . '" style="z-index:2" data-src="' . $value["background_img"] . '">';
                    $html .= '<img  class="p-0 position-absolute ' . $magaza_slider_css_class . '__child-draw ' . $show . '" style="z-index:3" data-src="' . $value["left_img"] . '">';
                    $html .= '<div class="position-relative ' . $magaza_slider_css_class . '__right-text-block ' . $show . '" style="z-index:3">';
                    $html .= '<div class="pt-5 text-white text-right pr-lg-5">';
                    $html .= '<div class="pt-lg-5 mt-5">';
                    $html .= '<h1 class="' . $magaza_slider_css_class . '__text-1 pt-lg-5">' . $value["title"] . '</h1>';
                    $html .= '<p class="' . $magaza_slider_css_class . '__text-2">' . $value["sub_title"] . '</p>';
                    $html .= '<p class="' . $magaza_slider_css_class . '__text-3">' . $value["manifesto"] . '</p>';
                    $html .= '</div><div class="' . $magaza_slider_css_class . '__desc text-right w-50 ml-auto ml"><div class="py-3">';
                    $html .= '<p class="lead">' . $value["desc"] . '</p>';
                    $html .= '</div></div>';
                    $html .= empty($value["button_link"]) ? "" : '<a name="" id="" style="" class="btn btn-outline-light btn-lg pl-lg-5 ' . $magaza_slider_css_class . '__button" href="' . $value["button_link"] . '" role="button">' . $value["button_text"] . '</a>';
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
        $html  = ob_get_clean();

        set_transient('home_page_slider_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $home_page_slider_html = $html;
        echo $home_page_slider_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $home_page_slider_html;
});


add_action('cart_html_output', __NAMESPACE__ . '\add_to_cart_template_html');



add_action('sorular_konusuyor_slider', function () {

    $sorular_konusuyor_slider_html = get_transient('sorular_konusuyor_slider_html');

    if (false === $sorular_konusuyor_slider_html) {

        $products = [];
        $carousel_indicator = [];
        $terms = get_terms("pa_sinif");
        $product_ids = [];
        $index = 0;
        $carausel_li_element = [];
        $sorular_konusuyor_slider_css_id = "sorular-konusuyor-slider";

        foreach ($terms as $term) {
            $lesson = str_replace("-sinif", "", $term->slug);
            $term_data = array(
                "name" => $term->name,
                "slug" => $term->slug,
                "lesson" => $lesson,
            );

            $products_query = new \WP_Query(array(
                'post_type' => array('product'),
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'pa_urun-cesitleri',
                        'field' => 'slug',
                        'terms' => array('sorular-konusuyor'),
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'pa_sinif',
                        'field' => 'slug',
                        'terms' => array($term->slug),
                        'operator' => 'IN',
                    )
                )
            ));

            // The Loop
            if ($products_query->have_posts()) : while ($products_query->have_posts()) :
                    $products_query->the_post();
                    $product_ids[] = $products_query->post->ID;

                    $product_data = array(
                        "lesson" => $lesson,
                        "category_name" => $term->name,
                        "products_inner" => $product_ids,
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            array_push($carousel_indicator, $term_data);
            array_push($products, $product_data);
            $product_ids = [];

            $active = ($index == 0) ? 'active' : '';
            $li_element = '<li data-target="#' . $sorular_konusuyor_slider_css_id . '" data-slide-to="' . $index . '" class="' . $active . '"><div>' . $lesson . '.</div></li>';
            array_push($carausel_li_element, $li_element);
            $index  += 1;
        }

        //print_r($products);
        ob_start();
    ?>
        <div id="<?php echo $sorular_konusuyor_slider_css_id ?>" class="carousel slide sorular-konusuyor__slider pl-lg-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                foreach ($carausel_li_element as $value) {
                    echo $value;
                }
                ?>
            </ol>
            <div class="carousel-inner">

                <?php
                $index = 0;
                $html = '';
                foreach ($products as $data) {
                    $active = ($index == 0) ? 'active' : '';
                    $html .= '<div class="carousel-item ' . $active . '">';
                    $html .= '<div class="row">';
                    foreach ($data["products_inner"] as $product_id) {
                        $title = get_the_title($product_id);
                        $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'medium');
                        $url = esc_url(get_permalink($product_id));
                        $html .= '<div class="col-6 col-sm-6 col-lg-6">';
                        $html .= '<div class="sorular-konusuyor__book-picture mx-auto text-center">';
                        $html .= '<a href="' . $url . '">' .  $image . '</a>';
                        $html .= '<h3 class="sorular-konusuyor__book-category">' . $data["category_name"] . '</h3>';
                        $html .= '<h3 class="sorular-konusuyor__book-branch">' . $title . '</h3>';
                        $html .= '</div></div>';
                    }
                    $html .= '</div></div>';
                    $index = +1;
                }
                echo $html;

                ?>
            </div>
        </div>
    <?php
        $html  = ob_get_clean();

        set_transient('sorular_konusuyor_slider_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $sorular_konusuyor_slider_html = $html;
        echo $sorular_konusuyor_slider_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $sorular_konusuyor_slider_html;
});


add_action("section_brans_denemeleri", function () {

    $section_brans_denemeleri_html = get_transient('section_brans_denemeleri_html');

    if (false === $section_brans_denemeleri_html) {

        $products = [];
        $carousel_indicator = [];
        $terms = get_terms("pa_sinif");
        $product_ids = [];

        foreach ($terms as $term) {
            $lesson = str_replace("-sinif", "", $term->slug);
            $term_data = array(
                "name" => $term->name,
                "slug" => $term->slug,
                "lesson" => $lesson,
            );

            $products_query = new \WP_Query(array(
                'post_type' => array('product'),
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'pa_urun-cesitleri',
                        'field' => 'slug',
                        'terms' => array('sinav-modu'),
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'pa_sinif',
                        'field' => 'slug',
                        'terms' => array($term->slug),
                        'operator' => 'IN',
                    )
                )
            ));

            // The Loop
            if ($products_query->have_posts()) : while ($products_query->have_posts()) :
                    $products_query->the_post();
                    $product_ids[] = $products_query->post->ID;

                    $product_data = array(
                        "lesson" => $lesson,
                        "category_name" => $term->name,
                        "products_inner" => $product_ids,
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            array_push($carousel_indicator, $term_data);
            if (isset($product_data)) {
                array_push($products, $product_data);
            }
            $product_ids = [];
        }

        //print_r($products);

        $html = '';
        foreach ($products as $data) {
            if (isset($data)) {
                foreach ($data["products_inner"] as $product_id) {
                    //$title = get_the_title($product_id);
                    $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), "woocommerce_medium");
                    $url = esc_url(get_permalink($product_id));
                    $html .= '<div class="col-6 col-sm-6 col-lg-3 text-center">';
                    $html .= '<div class="brans-denemeleri__book-picture">';
                    $html .= $image;
                    $html .= '<a name="" id="" class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="' . $url . '" role="button">İncele<i class="fa fa-external-link pl-2" aria-hidden="true"></i></a>';
                    $html .= '</div></div>';
                }
            }
        }
        set_transient('section_brans_denemeleri_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $section_brans_denemeleri_html = $html;
        echo $section_brans_denemeleri_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $section_brans_denemeleri_html;
});


add_action("section_teke_tek", function () {


    $section_teke_tek_html = get_transient('section_teke_tek_html');

    if (false === $section_teke_tek_html) {

        $products = [];
        $carousel_indicator = [];
        $terms = get_terms("pa_sinif");
        $product_ids = [];

        foreach ($terms as $term) {
            $lesson = str_replace("-sinif", "", $term->slug);
            $term_data = array(
                "name" => $term->name,
                "slug" => $term->slug,
                "lesson" => $lesson,
            );

            $products_query = new \WP_Query(array(
                'post_type' => array('product'),
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'pa_urun-cesitleri',
                        'field' => 'slug',
                        'terms' => array('teke-tek'),
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'pa_sinif',
                        'field' => 'slug',
                        'terms' => array($term->slug),
                        'operator' => 'IN',
                    )
                )
            ));

            // The Loop
            if ($products_query->have_posts()) : while ($products_query->have_posts()) :
                    $products_query->the_post();
                    $product_ids[] = $products_query->post->ID;

                    $product_data = array(
                        "lesson" => $lesson,
                        "category_name" => $term->name,
                        "products_inner" => $product_ids,
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            array_push($carousel_indicator, $term_data);
            if (isset($product_data)) {
                array_push($products, $product_data);
            }
            $product_ids = [];
        }

        //print_r($products);

        $html = '';
        foreach ($products as $data) {
            if (isset($data)) {
                $index = 0;
                foreach ($data["products_inner"] as $product_id) {
                    //$title = get_the_title($product_id);
                    $margin = ($index % 2) === 0 ? "pt-lg-5" : "";
                    $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'woocommerce_medium');
                    $url = esc_url(get_permalink($product_id));
                    $html .= '<div class="col-6 col-sm-6 col-lg-6 ' . $margin . '">';
                    $html .= '<a class="teke-tek__book-picture" href="' . $url . '">';
                    $html .= $image;
                    $html .= '</a></div>';
                    $index += 1;
                }
            }
        }
        set_transient('section_teke_tek_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $section_teke_tek_html = $html;
        echo $section_teke_tek_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $section_teke_tek_html;
});


add_action("section_muhendis_kafasi", function () {

    $section_muhendis_kafasi_html = get_transient('section_muhendis_kafasi_html');

    if (false === $section_muhendis_kafasi_html) {


        $products = [];
        $carousel_indicator = [];
        $terms = get_terms("pa_sinif");
        $product_ids = [];

        foreach ($terms as $term) {
            $lesson = str_replace("-sinif", "", $term->slug);
            $term_data = array(
                "name" => $term->name,
                "slug" => $term->slug,
                "lesson" => $lesson,
            );

            $products_query = new \WP_Query(array(
                'post_type' => array('product'),
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'pa_urun-cesitleri',
                        'field' => 'slug',
                        'terms' => array('muhendis-kafasi'),
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'pa_sinif',
                        'field' => 'slug',
                        'terms' => array($term->slug),
                        'operator' => 'IN',
                    )
                )
            ));

            // The Loop
            if ($products_query->have_posts()) : while ($products_query->have_posts()) :
                    $products_query->the_post();
                    $product_ids[] = $products_query->post->ID;

                    $product_data = array(
                        "lesson" => $lesson,
                        "category_name" => $term->name,
                        "products_inner" => $product_ids,
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            array_push($carousel_indicator, $term_data);
            if (isset($product_data)) {
                array_push($products, $product_data);
            }
            $product_ids = [];
        }

        //print_r($products);

        $html = '';
        foreach ($products as $data) {
            if (isset($data)) {
                foreach ($data["products_inner"] as $product_id) {
                    //$title = get_the_title($product_id);
                    $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'large');
                    $url = esc_url(get_permalink($product_id));
                    $html .= '<a class="muhendis-kafasi__book-picture" href="' . $url . '">';
                    $html .= $image;
                    $html .= '</a>';
                }
            }
        }

        set_transient('section_muhendis_kafasi_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $section_muhendis_kafasi_html = $html;
        echo $section_muhendis_kafasi_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $section_muhendis_kafasi_html;
});


add_action("section_yorumlar", function () {

    $section_yorumlar_html = get_transient('section_yorumlar_html');

    if (false === $section_yorumlar_html) {

        $carousel_indicator = [];
        $comments = [];

        $args = array(
            'post_type'   => 'testimonal',
            'orderby'    => 'menu_order',
            'sort_order' => 'asc',
            'fields' => 'ids',
        );

        $testimonals_ids = get_posts($args);

        foreach ($testimonals_ids as $testimonal_id) {
            $name = get_the_title($testimonal_id);
            $review = get_post_meta($testimonal_id, 'prv_testimonal_student_review', 1);
            $picture = wp_get_attachment_image(get_post_meta($testimonal_id, 'prv_testimonal_student_pic_id', 1), "", "", array("class" => "yorumlar__profile rounded-pill"));

            $comments_data = array(
                "name" => $name,
                "review" => $review,
                "picture" => $picture
            );

            //array_push($carousel_indicator, $term_data);
            array_push($comments, $comments_data);
        }
        $html = "";
        foreach ($comments as $data) {
            $html .= '<div class="w-75 p-3 yorumlar__wrapper">';
            $html .= '<div class="row">';
            $html .= '<div class="col-lg-2 text-right">';
            $html .=  $data["picture"];
            $html .= '</div><div class="col-lg-10 vmx-auto p-4 yorumlar__content">';
            $html .= '<h5 class="yorumlar__isim">' . $data["name"] . '</h5>';
            $html .= '<p class="yorumlar__yorum d-inline"> ' . $data["review"] . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        set_transient('section_yorumlar_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $section_yorumlar_html = $html;
        echo $section_yorumlar_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $section_yorumlar_html;
});

// Replace Woocommerce Pagination with bootstrap 4;
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop',  __NAMESPACE__ . '\\Core\\Bootstrap_Pagnition::bootstrap_pagination', 10, null);



// Flush Transients from Admin bar
function flush_transients_button()
{
    global $wp_admin_bar;

    // If User isnt even logged in or if admin bar is disabled
    if (!is_user_logged_in() || !is_admin_bar_showing())
        return false;

    // If user doesnt have the perms
    if (function_exists('current_user_can') && false == current_user_can('activate_plugins'))
        return false;

    // Button args
    $wp_admin_bar->add_menu(array(
        'parent' => '',
        'id' => 'flush_transients_button',
        'title' => __('Önbellek sil'),
        'meta' => array('title' => __('Bütün önbellekleri siler.')),
        'href' => wp_nonce_url(admin_url('index.php?action=deltransientpage'), 'flush_transients_button')
    ));
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\flush_transients_button', 35);




// Flush Transients
function flush_transients()
{
    global $_wp_using_ext_object_cache;

    // Check Perms
    if (function_exists('current_user_can') && false == current_user_can('activate_plugins'))
        return false;

    // Flush Cache
    if (isset($_GET['action']) && $_GET['action'] == 'deltransientpage' && (isset($_GET['_wpnonce']) ? wp_verify_nonce($_REQUEST['_wpnonce'], 'flush_transients_button') : false)) {

        // Get all Transients
        global $wpdb;
        $sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
    			FROM  $wpdb->options
            	WHERE `option_name` LIKE '%transient_%'
            	ORDER BY `option_name`";
        $get_all_site_transients = $wpdb->get_results($sql);

        // Delete all Transients
        foreach ($get_all_site_transients as $transient) {
            $transient_name = str_replace(array('_transient_timeout_', '_transient_', '_site_transient_', '_site_transient_timeout_'), '', $transient->name);
            delete_transient($transient_name);
        }

        // If using object cache
        if ($_wp_using_ext_object_cache) {
            // DELETE SPECIFIC CUSTOM TRANSIENTS - using a custom array
            /*foreach ($transients_custom_array as $transients_custom) {
	    		wp_cache_delete($transients_custom);
	    	}*/
            wp_cache_flush();
        }

        wp_redirect(admin_url() . '?cache_type=transients&cache_status=flushed');
        die();
    } else {
        wp_redirect(admin_url() . '?cache_type=transients&cache_status=not_flushed');
        die();
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'deltransientpage') {
    add_action('admin_init', __NAMESPACE__ . '\\flush_transients');
}

function flush_display_admin_msg()
{
    if (isset($_GET['cache_status']) == '')
        return;

    // Display Msg
    if ($_GET['cache_status'] == 'flushed') { ?>
        <div class="updated">
            <p><?php echo ucwords($_GET['cache_type']); ?> önbellek silme işlemi başarıyla tamamlandı.</p>
        </div>
    <?php
    } elseif ($_GET['cache_status'] == 'not_flushed') { ?>
        <div class="error">
            <p><?php echo ucwords($_GET['cache_type']); ?> önbellek silme işlemi başarısız oldu.</p>
        </div>
<?php
    }
}
add_action('admin_notices', __NAMESPACE__ . '\\flush_display_admin_msg');
