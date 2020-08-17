<?php

namespace App;



add_shortcode('contact-form', function () {

    if (isset($_POST['submitted'])) {
        if (trim($_POST['fname']) === '') {
            $nameError = 'Lütfen isminizi giriniz.';
            $hasError = true;
        } else {
            $name = trim($_POST['fname']);
        }

        if (trim($_POST['lname']) === '') {
            $lastNameError = 'Lütfen soyisminizi giriniz.';
            $hasError = true;
        } else {
            $lname = trim($_POST['lname']);
        }

        if (trim($_POST['email']) === '') {
            $emailError = 'Lütfen mail adresinizi giriniz.';
            $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
            $emailError = 'Geçersiz bir mail adresi girdiniz. Lütfen tekrar deneyin.';
            $hasError = true;
        } else {
            $email = trim($_POST['email']);
        }

        if (trim($_POST['comments']) === '') {
            $commentError = 'Lütfen bir mesaj giriniz.';
            $hasError = true;
        } else {
            if (function_exists('stripslashes')) {
                $comments = stripslashes(trim($_POST['comments']));
            } else {
                $comments = trim($_POST['comments']);
            }
        }

        if (!isset($hasError)) {
            $emailTo = get_option('tz_email');
            if (!isset($emailTo) || ($emailTo == '')) {
                $emailTo = get_option('admin_email');
            }
            $subject = $name . ' ' . $lname . ' isimli kişiden 1 mesajınız var.';
            $body = "İsim: $name \n\nSoyisim: $lname \n\nE-Posta: $email \n\nMesaj: $comments";
            $headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
            wp_mail($emailTo, $subject, $body, $headers);
            $emailSent = true;
        }
    }

    ob_start();

?>
    <div id="contact" class="container-fluid contact">
        <div class="row">
            <div class="col-lg-4 contact__info vmx-auto p-5">
                <div>
                    <h2><i class="fa fa-phone pr-2" aria-hidden="true"></i>Telefon</h2>
                    <ul>
                        <li>0850 305 03 72 / <strong>Merkez</strong></li>
                        <li>0 216 307 73 63 / <strong>Ürün Teslimat</strong></li>
                    </ul>
                    <h2><i class="fa fa-envelope pr-2" aria-hidden="true"></i>E-Posta</h2>
                    <ul>
                        <li><a href="mailto:bilgi@pruvaakademi.com">bilgi@pruvaakademi.com</a></li>
                    </ul>
                    <h2><i class="fa fa-location-arrow pr-2" aria-hidden="true"></i>Adres</h2>
                    <ul>
                        <li>Kaynarca Mh. Aydınlı Yolu Cd. No.137</li>
                        <li>Mavi Kule Residence Kat 13 D.65</li>
                        <li>Pendik / İstanbul</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 contact__form p-5">

                <?php if (isset($emailSent) && $emailSent == true) { ?>

                    <div class="alert alert-success alert-contact" role="alert">
                        <p>Mailiniz başarıyla gönderildi.</p>
                    </div>
                    <div class="text-center"><i class="fa fa-check succes-icon" aria-hidden="true"></i></div>
                    <?php
                    global $wp;
                    $emailSent == false;
                    $page = home_url($wp->request);
                    $sec = "3";
                    header("Refresh: $sec; url=$page");
                    ?><?php } else { ?> <?php if (isset($hasError) || isset($captchaError)) { ?>

                        <div class="alert alert-danger alert-contact" role="alert">
                            <p>Mailiniz gönderilirken bir problem oluştu. Lütfen tekrar deneyin</p>
                        </div>


                    <?php } ?>
                    <form action="<?php the_permalink(); ?>" id="contactForm" method="post" novalidate>
                        <div class="contact-form">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="fname">Adınız: </label>
                                <div class="col">
                                    <input type="text" class="form-control required-field" name="fname" id="fname" placeholder="Adınızı giriniz" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" required />
                                    <div class="invalid-feedback">Lütfen isminizi girin.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="lname">Soyadınız: </label>
                                <div class="col">
                                    <input type="text" class="form-control required-field" id="lname" placeholder="Soyadınızı giriniz" name="lname" required>
                                    <div class="invalid-feedback">Lütfen soyisminizi girin.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Mail adresiniz:</label>
                                <div class="col">
                                    <input type="email" class="form-control required-field email" id="email" placeholder="Mail adresinizi giriniz" name="email" value="<?php if (isset($_POST['email']))  echo $_POST['email']; ?>" required />
                                    <div class="invalid-feedback">Lütfen geçerli bir e-mail adresi giriniz.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="comments">Mesajınız:</label>
                                <div class="col">
                                    <textarea name="comments" id="commentsText" rows="10" cols="30" class="form-control required-field" required><?php if (isset($_POST['comments'])) {
                                                                                                                                                        if (function_exists('stripslashes')) {
                                                                                                                                                            echo stripslashes($_POST['comments']);
                                                                                                                                                        } else {
                                                                                                                                                            echo $_POST['comments'];
                                                                                                                                                        }
                                                                                                                                                    } ?></textarea>
                                    <div class="invalid-feedback">Zorunlu alandır lütfen doldurunuz.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" id="form-submit-contact">Gönder</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="submitted" id="contact-forms-submitted" value="true" />
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php

    $buffer  = ob_get_clean();
    // Output needs to be return
    return $buffer;
});




add_shortcode('digital-catalog', function () {


    $digital_catalog_html = get_transient('digital_catalog_html');

    if (false === $digital_catalog_html) {

        $nf = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $products = [];
        $carousel_indicator = [];
        $terms = get_terms("pa_sinif");
        $product_ids = [];
        $lessonsData = [];

        foreach ($terms as $term) {
            $lesson = str_replace("-sinif", "", $term->slug);
            $lessonsData[] = array(
                "lesson-in-number" => $lesson,
                "lesson-in-name" => $term->name,
            );
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
                        'operator' => 'EXISTS',
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
                    $product_id = $products_query->post->ID;
                    $product_ids[] = $product_id;
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
        ob_start();
        //print_r($products);
    ?>
        <div class="row">
            <div class="col-12 text-center">
                <div class="btn-group filters-button-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-primary" is-checked" data-filter="*">Tümü</button>
                    <?php
                    $html = '';
                    foreach ($lessonsData as $data) {
                        $html .= '<button type="button" class="btn btn-outline-primary" data-filter=".' . $nf->format($data["lesson-in-number"]) . '">' . $data["lesson-in-name"] . '</button>';
                    }
                    echo $html;
                    ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5 filterable-catalog">

                <?php
                $html = '';
                foreach ($products as $data) {
                    $lesson_in_number = $nf->format($data["lesson"]);
                    foreach ($data["products_inner"] as $product_id) {
                        $title = get_the_title($product_id);
                        $image = wp_get_attachment_image(get_post_thumbnail_id($product_id), 'medium', false, ["class" => "card-img-top"]);
                        $badge = product_coming_soon_badge($product_id, "sorular-konusuyor");
                        $url = esc_url(get_permalink($product_id));
                        $video_tanitim = esc_url(get_post_meta($product_id, 'prv_video-tanitim_url', 1));
                        $demo_kitap = esc_url(get_post_meta($product_id, 'prv_kitap_inceleme_pdf', 1));
                        $html .= '<div class="col col-md-6 col-lg-3 card-container ' . $lesson_in_number . '">';
                        $html .= '<div class="card">';
                        $html .= '<a href="' . $url . '">' .  $image . '</a>';
                        $html .= '<div class="card-body">';
                        $html .= '<h5 class="card-title text-center">' . $title . '</h5>';
                        $html .= '<p class="card-text">Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir.</p>';
                        $html .= \App\pdf_modal_html();
                        $html .= '<button type="button" class="btn btn-outline-warning btn-block pdf__view-button" data-toggle="modal" data-target="#PDFModal" data-src="' . $demo_kitap . '"><i class="fa fa-file-text pr-3" aria-hidden="true"></i>DEMO KİTAP</button>';
                        $html .= '<!-- modal start -->
                    <div class="modal fade neden-sorular-konusuyor__modal" id="Book-Video-Promotion" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog neden-sorular-konusuyor__modal-dialog" role="document">
                        <div class="modal-content shadow-lg">
                          <div class="modal-body neden-sorular-konusuyor__modal-body">
                            <button type="button"
                              class="btn btn-light rounded-pill modal-close neden-sorular-konusuyor__model-close"
                              data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="" id="Book-Promotion-Video" allowscriptaccess="always"
                                allow="autoplay"></iframe>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal end -->
                  <button type="button" class="btn btn-outline-info btn-block mt-1 pr-3 book-advertise__play-button" data-toggle="modal"
                   data-src="' .  $video_tanitim . '" data-target="#Book-Video-Promotion"><i
                   class="fa fa-play book-advertise__play pr-3" aria-hidden="true"></i>TANITIM VİDEOSU</button>';
                        $html .= '</div></div></div>';
                    }
                }
                echo $html;
                ?>
            </div>
        </div>

<?php
        $html  = ob_get_clean();

        set_transient('digital_catalog_html', $html, 86400);

        echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Not Cached</h5>' : "";
        $digital_catalog_html = $html;
        echo $digital_catalog_html;
        return;
    }
    echo (WP_PRV_THEME_DEBUG === true) ? '<h5>Cached</h5>' : "";
    echo $digital_catalog_html;
});
