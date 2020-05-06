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
