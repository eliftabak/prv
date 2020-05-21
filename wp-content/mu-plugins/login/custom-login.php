<?php


require(dirname(__FILE__) . "/helpers/login-utility.php");

class StepLogin
{

  public function __construct()
  {

    add_action('wp_ajax_register_user_front_end', array($this, 'register_process'), 0);
    add_action('wp_ajax_nopriv_register_user_front_end', array($this, 'register_process'));
    add_shortcode('register_form', array($this, 'html_logic'));
  }

  function html_logic()
  {

    if (!is_user_logged_in()) {
      return $this->registration_form_html();
    } else {
      $user_id = get_current_user_id();
      $user_type = get_user_meta($user_id, "prv_user_type", true);
      $user_validation_status = get_user_meta($user_id, "prv_user_validate", true);

      if ($user_type === "Öğretmen") {
        if ($user_validation_status === "Onaylanmadı") {
          return $this->validation_waiting_html();
        } elseif ($user_validation_status === "Onaylandı") {
          return $this->akilli_defter_html();
        }
      } else {
        return $this->change_user_type_to_ogretmen_html();
      }
    }
  }

  function validation_waiting_html()
  {
    ob_start(); ?>

    <h3 class="text-center">Onay süreciniz devam ediyor.</h3>

  <?php
    return ob_get_clean();
  }


  function change_user_type_to_ogretmen_html()
  {
    ob_start(); ?>

    <h3 class="text-center">Ogretmen Olmak istiyorum</h3>


    </script>
  <?php
    return ob_get_clean();
  }


  function akilli_defter_html()
  {
    ob_start(); ?>

    <h3 class="text-center">Akıllı defterleriniz.</h3>


    </script>
  <?php
    return ob_get_clean();
  }

  function registration_form_html()

  {

    ob_start(); ?>
    <h3 class="text-center">Talep Formu</h3>

    <div class="notice" style="display:none"></div>

    <div id="stepperFormAkilli" class="bs-stepper linear">
      <div class="bs-stepper-header" role="tablist">
        <div class="step active" data-target="#test-form-1">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1" aria-selected="true">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label">Kayıt</span>
          </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-2">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label">Genel bilgiler</span>
          </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-3">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label">Sonuç</span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form class="needs-validation akilli-tahta-talep-form" onsubmit="return false" novalidate="" action="#" method="POST" name="akilli-tahta-talep-form">
          <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade active dstepper-block" aria-labelledby="stepperFormTrigger1">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="user-email">E-Posta adresiniz <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" id="user-email" type="mail" name="user-email" class="form-control" placeholder="Mail adresi giriniz" required data-cip-id="user-email">
                        <div class="invalid-feedback">Geçerli bir mail adresi giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="user-display-name">Kullaıcı Adınız<span class="text-danger font-weight-bold">*</span></label>
                        <input id="user-display-name" type="text" name="user-display-name" class="form-control" placeholder="Kullanıcı adınızı giriniz" required data-cip-id="user-display-name">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-first-name">Adınız <span class="text-danger font-weight-bold">*</span></label>
                        <input id="user-first-name" name="user-first-name" type="text" class="form-control" placeholder="Adınızı giriniz" required data-cip-id="user-first-name">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-last-name">Soyadınız <span class="text-danger font-weight-bold">*</span></label>
                        <input id="user-last-name" name="user-last-name" type="text" class="form-control" placeholder="Soyadınızı giriniz" required data-cip-id="user-last-name">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-password">Şifre <span class="text-danger font-weight-bold">*</span></label>
                        <input id="user-password" name="user-password" type="password" class="form-control" placeholder="Şifrenizi giriniz" required data-cip-id="user-password">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-password-repeat">Şifre Tekrar <span class="text-danger font-weight-bold">*</span></label>
                        <input id="user-password-repeat" name="user-password-repeat" type="password" class="form-control" placeholder="Tekrar şifrenizi giriniz" required data-cip-id="user-password-repeat">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 vmx-auto">
                  <div class="row justify-content-center">
                    <div class="col-sm-8 imgUp">
                      <div class="imagePreview" id="user-image"></div>
                      <label class="btn btn-primary btn-img-upload">
                        Öğretmen Kimliğinizi Yükleyin
                        <input required type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                        <div class="invalid-feedback">Lütfen bir fotoğraf yükleyiniz.</div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-right mt-5">
                <button class="btn btn-info btn-lg shadow btn-next-form d-inline-block">Sonraki</button>
              </div>
            </div>
          </div>
          <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger2">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-city">İl <span class="text-danger font-weight-bold">*</span></label>
                    <input id="user-city" type="text" name="user-city" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="user-city">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-district">İlçe <span class="text-danger font-weight-bold">*</span></label>
                    <input id="user-district" type="text" name="user-district" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="user-district">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="user-school">Okul <span class="text-danger font-weight-bold">*</span></label>
                    <input id="user-school" type="text" name="user-school" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="user-school">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-subject">Branş <span class="text-danger font-weight-bold">*</span></label>
                    <input id="user-subject" type="text" name="user-subject" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="user-subject">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-phone">Telefon <span class="text-danger font-weight-bold">*</span></label>
                    <input id="user-phone" type="text" name="user-phone" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="user-phone">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-right mt-5">
                <button class="btn btn-info btn-lg shadow btn-previous-form d-inline-block">Önceki</button>
                <button class="btn btn-info btn-lg shadow btn-next-form d-inline-block">Sonraki</button>
              </div>
            </div>
          </div>
          <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center dstepper-none" aria-labelledby="stepperFormTrigger3">
            <input type="hidden" name="prv_user_register_nonce" value="<?php echo wp_create_nonce('prv-user-register-nonce'); ?>" id="prv-user-register-nonce" />
            <div class="container-fluid text-right mt-5">
              <button class="btn btn-info btn-lg shadow btn-previous-form d-inline-block">Önceki</button>
              <button type="submit" class="btn btn-success btn-lg shadow d-inline-block" id="akilli-tahta-submit"><i class="fa fa-paper-plane pr-2" aria-hidden="true"></i>Gönder</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
      jQuery('#akilli-tahta-submit').on('click', function(e) {
        e.preventDefault();
        var user_email = jQuery('#user-email').val();
        var user_display_name = jQuery('#user-display-name').val();
        var user_first_name = jQuery('#user-first-name').val();
        var user_last_name = jQuery('#user-last-name').val();
        var user_password = jQuery('#user-password').val();
        var user_password_repeat = jQuery('#user-password-repeat').val();
        var user_image = jQuery('#user-image').css("background-image");
        var user_city = jQuery('#user-city').val();
        var user_district = jQuery('#user-district').val();
        var user_school = jQuery('#user-school').val();
        var user_subject = jQuery('#user-subject').val();
        var user_phone = jQuery('#user-phone').val();
        var prv_user_register_nonce = jQuery('#prv-user-register-nonce').val();



        var reg = /(?:\(['"]?)(.*?)(?:['"]?\))/;
        var extracted_image = reg.exec(user_image)[1];

        jQuery.ajax({
          type: "POST",
          url: "<?php echo admin_url('admin-ajax.php'); ?>",
          data: {
            action: "register_user_front_end",
            user_email: user_email,
            user_display_name: user_display_name,
            user_first_name: user_first_name,
            user_last_name: user_last_name,
            user_password: user_password,
            user_password_repeat: user_password_repeat,
            user_image: extracted_image,
            user_city: user_city,
            user_district: user_district,
            user_school: user_school,
            user_subject: user_subject,
            user_phone: user_phone,
            prv_user_register_nonce: prv_user_register_nonce,
          },
          success: function(results) {
            //console.log(results);
            const element = jQuery('.notice');

            const {
              data
            } = results
            if ("success" in data) {
              data["success"].forEach((value, index) => {
                element.append(`<div class="alert alert-success" role="alert">${value}</div>`);
                if (data["success"].length - 1 == index) {
                  element.show();
                }
              });
            }

            setTimeout(() => {
              element.hide();
              element.empty();
              window.location.reload();
            }, 3000)


          },
          error: function(results) {
            //console.log("results", results)
            const element = jQuery('.notice');
            const {
              data
            } = JSON.parse(results.responseText);

            if ("error" in data) {
              data["error"].forEach((value, index) => {
                element.append(`<div class="alert alert-warning" role="alert">${value}</div>`);
                if (data["error"].length - 1 == index) {
                  element.show();
                }
              });
            }

            setTimeout(() => {
              element.hide();
              element.empty();
            }, 3000)

          }
        });
      });
    </script>
<?php
    return ob_get_clean();
  }

  function register_process()
  {

    if (isset($_POST["user_display_name"]) && wp_verify_nonce($_POST['prv_user_register_nonce'], 'prv-user-register-nonce')) {

      $user_login    = $_POST["user_display_name"];
      $user_email    = $_POST["user_email"];
      $user_first   = $_POST["user_first_name"];
      $user_last     = $_POST["user_last_name"];
      $user_pass    = $_POST["user_password"];
      $pass_confirm   = $_POST["user_password_repeat"];
      $user_image = $_POST["user_image"];

      $error = [];

      // this is required for username checks
      require_once(ABSPATH . WPINC . '/registration.php');

      if (preg_match('/^data:image\/(\w+);base64,/', $user_image, $type)) {
        $user_image = substr($user_image, strpos($user_image, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
          $error["error"][] = 'Jpeg, gif  veya png formatlarından birini yükleyiniz. ';
        }

        $user_image = base64_decode($user_image);

        if ($user_image === false) {
          $error["error"][] = 'Resim işlenirken hata verdi.';
        }
      } else {
        $error["error"][] = 'Başka bir resim deneyerek tekrar yüklemeyi deneyiniz.';
      }

      $upload = wp_upload_dir();
      $upload_dir = $upload['basedir'];
      $year = date("Y");
      $month = date('m');
      $date = new DateTime();
      $time_stamp =  $date->getTimestamp();
      $full_path =  "{$upload_dir}/{$year}/{$month}/";
      $file_name = strtolower($user_first) . "-" . strtolower($user_last) . "-" . $time_stamp . "." . $type;

      file_put_contents($full_path . $file_name, $user_image);

      if (username_exists($user_login)) {
        // Username already registered
        $error["error"][] = "Bu kullanıcı adı sistemde kayıtlı.";
      }
      if (!validate_username($user_login)) {
        // invalid username
        $error["error"][] = "Geçersiz kullanıcı adı giriniz.";
      }
      if ($user_login == '') {
        // empty username
        $error["error"][] = "Lütfen bir kullanıcı adı giriniz.";
      }
      if (!is_email($user_email)) {
        //invalid email
        $error["error"][] = "Geçerli bir e-posta adresi giriniz.";
      }
      if (email_exists($user_email)) {
        //Email address already registered
        $error["error"][] = "Bu e-posta adresi sistemde kayıtlı.";
      }
      if ($user_pass == '') {
        // passwords empty
        $error["error"][] = "Lütfen bir şifre giriniz.";
      }
      if ($user_pass != $pass_confirm) {
        // passwords do not match
        $error["error"][] = "Girdiğiniz şifre eşleşmiyor.";
      }

      if ($error) {
        wp_send_json_error($error, 500);
      } else {
        $json = [];
        $new_user_id = wp_insert_user(
          array(
            'user_login'    => $user_login,
            'user_pass'       => $user_pass,
            'user_email'    => $user_email,
            'first_name'    => $user_first,
            'last_name'      => $user_last,
            'user_registered'  => date('Y-m-d H:i:s'),
            'role'        => 'customer'
          )
        );
        if ($new_user_id) {
          // Update Metadata
          update_user_meta($new_user_id, "prv_user_type", "Öğretmen");
          update_user_meta($new_user_id, "prv_user_validate", "Onaylanmadı");


          // send an email to the admin alerting them of the registration
          wp_new_user_notification($new_user_id);

          // send an email to the admin alerting them of the registration
          send_welcome_email_to_new_user($new_user_id);

          // log the new user in
          wp_set_auth_cookie($new_user_id);
          wp_set_current_user($new_user_id, $user_login);
          //do_action('wp_login', $user_login);

          $data["success"][] = "Talebiniz başarıyla tarafımıza ulaşmıştır.";
          wp_send_json_success($data, 200);
        }
      }
    } else {
      wp_die();
    }
  }
}

new StepLogin();
