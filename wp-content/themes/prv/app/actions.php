<?php

namespace App;

add_action('woocommerce_cart_is_empty', function () {
    echo 'woocommerce_cart_is_empty_hooks';
});

add_action('after_setup_theme', function () {
    show_admin_bar(false);
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
    $buffer  = ob_get_clean();
    echo  $buffer;
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
                $html .= '<img loading="lazy" class="p-0 position-absolute ' . $magaza_slider_css_class . '__left-image ' . $show . '" style="z-index:2" src="' . $value["background_img"] . '">';
                $html .= '<img loading="lazy" class="p-0 position-absolute ' . $magaza_slider_css_class . '__child-draw ' . $show . '" style="z-index:3" src="' . $value["left_img"] . '">';
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
    $buffer  = ob_get_clean();
    echo  $buffer;
});


add_action('cart_html_output', __NAMESPACE__ . '\add_to_cart_template_html');



add_action('sorular_konusuyor_slider', function () {

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
    <div id="<?php echo $sorular_konusuyor_slider_css_id ?>" class="carousel slide sorular-konusuyor__slider pl-5" data-ride="carousel">
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
            foreach ($products as $data) {
                $active = ($index == 0) ? 'active' : '';
                $html .= '<div class="carousel-item ' . $active . '">';
                $html .= '<div class="row">';
                foreach ($data["products_inner"] as $product_id) {
                    $title = get_the_title($product_id);
                    $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'medium');
                    $url = esc_url(get_permalink($product_id));
                    $html .= '<div class="col-sm-6 col-lg-6">';
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
    $buffer  = ob_get_clean();
    echo $buffer;
});


add_action("section_brans_denemeleri", function () {

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
        array_push($products, $product_data);
        $product_ids = [];
    }

    //print_r($products);
    ob_start();
?>
    <?php
    foreach ($products as $data) {
        if (isset($data)) {
            foreach ($data["products_inner"] as $product_id) {
                //$title = get_the_title($product_id);
                $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), "large");
                $url = esc_url(get_permalink($product_id));
                $html .= '<div class="col-sm-6 col-lg-3 text-center">';
                $html .= '<div class="brans-denemeleri__book-picture">';
                $html .= $image;
                $html .= '<a name="" id="" class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="' . $url . '" role="button">İncele<i class="fa fa-external-link pl-2" aria-hidden="true"></i></a>';
                $html .= '</div></div>';
            }
        }
    }
    echo $html;
    ?>
<?php
    $buffer = ob_get_clean();
    echo $buffer;
});


add_action("section_teke_tek", function () {

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
        array_push($products, $product_data);
        $product_ids = [];
    }

    //print_r($products);
    ob_start();
?>

    <?php
    foreach ($products as $data) {
        if (isset($data)) {
            $index = 0;
            foreach ($data["products_inner"] as $product_id) {
                //$title = get_the_title($product_id);
                $margin = ($index % 2) === 0 ? "pt-lg-5" : "";
                $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'large');
                $url = esc_url(get_permalink($product_id));
                $html .= '<div class="col-sm-6 col-lg-6 ' . $margin . '">';
                $html .= '<a class="teke-tek__book-picture" href="' . $url . '">';
                $html .= $image;
                $html .= '</a></div>';
                $index += 1;
            }
        }
    }
    echo $html;
    ?>
<?php
    $buffer  = ob_get_clean();
    echo  $buffer;
});


add_action("section_muhendis_kafasi", function () {

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
        array_push($products, $product_data);
        $product_ids = [];
    }

    //print_r($products);
    ob_start();
?>
    <?php
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
    echo $html;
    ?>

<?php
    $buffer  = ob_get_clean();
    echo  $buffer;
});


add_action("section_yorumlar", function () {

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

    //print_r($comments);
    ob_start();
?>

    <?php
    foreach ($comments as $data) {
        $html = '<div class="w-75 p-3 yorumlar__wrapper">';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-2 text-right">';
        $html .=  $data["picture"];
        $html .= '</div><div class="col-lg-10 vmx-auto p-4 yorumlar__content">';
        $html .= '<h5 class="yorumlar__isim">' . $data["name"] . '</h5>';
        $html .= '<p class="yorumlar__yorum d-inline"> ' . $data["review"] . '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        echo $html;
    }
    ?>
<?php
    $buffer  = ob_get_clean();
    echo  $buffer;
});
