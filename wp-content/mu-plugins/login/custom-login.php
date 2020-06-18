<?php

//TODO:Continue from here
use Automattic\WooCommerce\Admin\API\Init;

require(dirname(__FILE__) . "/helpers/login-utility.php");

require(dirname(__FILE__) . "/helpers/db-utility.php");

require(dirname(__FILE__) . "/helpers/rest-utility.php");

require(dirname(__FILE__) . "/helpers/file-utility.php");
class StepLogin
{

  private $login_db;
  private $rest_routes;
  private $site_url;
  private $city_path = "/wp-json/prv_login/v1/cities";
  private $district_path = "/wp-json/prv_login/v1/districts";
  private $school_path = "/wp-json/prv_login/v1/schools";


  public function __construct()
  {
    $this->login_db = new DatabaseHandling();
    $this->rest_routes = new RestRoutes($this->login_db);
    $this->database();
    $this->load_routes();
    $this->register_actions();
    $this->site_url = site_url();
  }

  private function load_routes()
  {
    return $this->rest_routes->load_all_routes();
  }

  private function database()
  {

    if (!$this->login_db->check_db_exist()) {
      $this->create_dbs();
      $this->insert_datas();
    } else {
      return;
    }
  }

  private function register_actions()
  {
    add_action('wp_ajax_register_user_front_end', array($this, 'register_process'), 0);
    add_action('wp_ajax_nopriv_register_user_front_end', array($this, 'register_process'));
    add_shortcode('register_form', array($this, 'html_logic'));
  }

  private function create_dbs()
  {

    return  $this->login_db->cretate_dbs();
  }


  private function insert_datas()
  {

    return  $this->login_db->instert_datas();
  }



  public function html_logic()
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

  public function validation_waiting_html()
  {
    ob_start(); ?>
    <div class="w-100 text-center">
      <div id="hourglass" class="fa-stack fa-4x">
        <i class="fa fa-stack-1x fa-hourglass-start"></i>
        <i class="fa fa-stack-1x fa-hourglass-half"></i>
        <i class="fa fa-stack-1x fa-hourglass-end"></i>
        <i class="fa fa-stack-1x fa-hourglass-end"></i>
        <i class="fa fa-stack-1x fa-hourglass-o"></i>
      </div>
    </div>
    <h3 class="text-center">Onay süreciniz devam ediyor. Beklediğiniz için teşşekkür ederiz.</h3>
  <?php
    return ob_get_clean();
  }


  public function change_user_type_to_ogretmen_html()
  {
    ob_start(); ?>

    <h3 class="text-center">Ogretmen Olmak istiyorum</h3>


    </script>
  <?php
    return ob_get_clean();
  }


  public function akilli_defter_html()
  {

    $posts = get_posts([
      'post_type' => 'akilli_tahta',
      'post_status' => 'publish',
      'numberposts' => -1,
      'order' => 'ASC'
    ]);


    //TODO: akıllı tahta zip dosyasında hata var. Kontrol et
    ob_start(); ?>
    <div class="container-fluid">
      <div class="row">
        <?php
        foreach ($posts as $post) {
          $title = get_the_title($post);
          $file = get_post_meta($post->ID, "prv_akilli_tahta")[0];
          $thumbnail = get_the_post_thumbnail($post, "medium")
          //print_r($post);
        ?>
          <div class="col-lg-4">

            <div class="card text-left">
              <div class="w-100 text-center">
                <?php echo $thumbnail ?>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $title ?></h5>
                <a name="" id="" class="btn btn-primary btn-block pt-2 pm-2" href="<?php echo $file  ?>" role="button">
                  <i class="fa fa-download pr-2" aria-hidden="true"></i>
                  İNDİR</a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>





    </script>
  <?php
    return ob_get_clean();
  }

  public function registration_form_html()

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
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-first-name">Adınız <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$" id="user-first-name" name="user-first-name" type="text" class="form-control" placeholder="Adınızı giriniz" required data-cip-id="user-first-name">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="user-last-name">Soyadınız <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$" id="user-last-name" name="user-last-name" type="text" class="form-control" placeholder="Soyadınızı giriniz" required data-cip-id="user-last-name">
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
                        <div class="invalid-feedback">Lütfen bir fotoğraf yükleyiniz. <br> Fotoğraf boyutunuz 3mb'den az olmalıdır.</div>
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
                    <?php
                    $city_url = "{$this->site_url}{$this->city_path}";
                    $request_response = file_get_contents($city_url);
                    $data = $request_response;
                    $cities = json_decode($request_response, true);
                    $cities = [["city_id" => "", "name" => "İl seçiniz..."], ...$cities];
                    $data = [];
                    foreach ($cities as $value) {
                      $id = $value["city_id"];
                      $city = $value["name"];
                      $data[$id] = $city;
                    };
                    woocommerce_form_field('user-city', array(
                      'type'        => 'select',
                      'required'    => true,
                      'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                      'input_class' => ["form-control form-control-lg"],
                      'options' => $data
                    ));
                    ?>
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-district">İlçe <span class="text-danger font-weight-bold">*</span></label>
                    <?php
                    woocommerce_form_field('user-district', array(
                      'type'        => 'select',
                      'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                      'select_class' => ["form-control form-control-lg"],
                      'placeholder' => 'Bir seçenek belirleyin..',
                      'options' => array('' => 'İlçe seçiniz...')
                    ));
                    ?>
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="user-school">Okul <span class="text-danger font-weight-bold">*</span></label>
                    <?php
                    woocommerce_form_field('user-school', array(
                      'type'        => 'select',
                      'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                      'select_class' => ["form-control form-control-lg"],
                      'placeholder' => 'Bir seçenek belirleyin..',
                      'options' => array('' => 'Okul seçiniz...')
                    ));
                    ?>
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-subject">Branş <span class="text-danger font-weight-bold">*</span></label>
                    <?php
                    $brans = array(
                      '' => 'Branş seçiniz...',
                      "TÜRKÇE" => "TÜRKÇE",
                      "MATEMATİK" => "MATEMATİK",
                      "FEN BİLİMLERİ" => "FEN BİLİMLERİ",
                      "SOSYAL BİLGİLER" => "SOSYAL BİLGİLER",
                      "İNGİLİZCE" => "İNGİLİZCE",
                      "DİN KÜLTÜRÜ VE AHLAK BİLGİSİ" => "DİN KÜLTÜRÜ VE AHLAK BİLGİSİ",
                    );
                    woocommerce_form_field('user-subject', array(
                      'type'        => 'select',
                      'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                      'select_class' => ["form-control form-control-lg"],
                      'options' => $brans
                    ));
                    ?>
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user-phone">Telefon <span class="text-danger font-weight-bold">*</span></label>
                    <input pattern="^(05(\d{9}))$" id="user-phone" type="text" name="user-phone" class="form-control form-control-lg" placeholder="Numaranızı giriniz..." required data-cip-id="user-phone">
                    <div class="invalid-feedback">Telefon numarası 05 ile başlamalı ve bitişik yazılmalıdır. <br> Toplam 11 hane olmalıdır.<br> Örneğin : 05*********</div>
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
            <div class="col-lg-12 text-left">
              <div class="form-check mt-5">
                <input type="checkbox" class="form-check-input" id="user-check-1">
                <label class="form-check-label" for="user-check-1">FORM ÜZERİNDE BİLGİLERİ EKSİKSİZ BİR ŞEKİLDE DOLDURDUM.</label>
              </div>
              <div class="form-check mt-5">
                <input type="checkbox" class="form-check-input" id="user-check-2">
                <label class="form-check-label" for="user-check-2">İLETİŞİM BİLGİLERİM BENİMLE İLETİŞİME GEÇMEK İÇİN KULLANILABİLİR.</label>
              </div>
              <div class="form-group mt-5">
                <label for="user-message">Mesajınız</label>
                <textarea class="form-control" rows="3" id="user-message"></textarea>
              </div>
            </div>
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
      (function($) {

        const $city = $('#user-city');
        const $district = $('#user-district');
        const $school = $('#user-school');

        const state = {}

        function resetCity() {

          $city.find("option").remove();

        }

        function resetDistrict() {

          $district.find("option").remove();

        }

        function resetSchool() {

          $school.find("option").remove();

        }

        function getSchoolById() {
          const url = '<? echo "{$this->site_url}{$this->school_path}"  ?>' + `?city=${state.cityId}&district=${state.districtId}`;
          $.getJSON(url, function(data) {
            let index = 0;
            let schools = data.map(function(el) {
              if (index === 0) {
                index += 1;
                return `<option value="" selected="selected">Okul seçiniz...</option>
                        <option value="${el.school_id}" selected="selected">${el.name.toLocaleUpperCase("tr")}</option>`
              } else {
                return `<option value="${el.school_id}">${el.name.toLocaleUpperCase("tr")}</option>`
              }
            })
            schools = schools.join('');
            resetSchool();
            $school.append(schools);

          });
        }

        function getDistrictById() {
          const url = '<? echo "{$this->site_url}{$this->district_path}"  ?>' + `?city=${state.cityId}`;
          $.getJSON(url, function(data) {
            let index = 0;
            let districts = data.map(function(el) {
              if (index === 0) {
                index += 1;
                return `<option value="" selected="selected">İlçe seçiniz...</option>
                        <option value="${el.district_id}" selected="selected">${el.name}</option>`
                state.districtId = el.district_id;
              } else {
                return `<option value="${el.district_id}">${el.name}</option>`
              }
            })
            districts = districts.join('');
            resetDistrict();
            $district.append(districts);
            getSchoolById();
          });
        }

        $city.on('change', function() {

          const id = $(this).find("option").filter(':selected').val();

          state.cityId = id;

          getDistrictById();

        })



        $district.on('change', function() {

          const id = $(this).find("option").filter(':selected').val();

          state.districtId = id;

          getSchoolById();

        })

        $('#akilli-tahta-submit').on('click', function(e) {
          e.preventDefault();
          var user_email = $('#user-email').val();
          var user_display_name = user_email;
          var user_first_name = $('#user-first-name').val();
          var user_last_name = $('#user-last-name').val();
          var user_password = $('#user-password').val();
          var user_password_repeat = $('#user-password-repeat').val();
          var user_image = $('#user-image').css("background-image");
          var user_city = $('#user-city').val();
          var user_district = $('#user-district').val();
          var user_school = $('#user-school').val();
          var user_subject = $('#user-subject').val();
          var user_phone = $('#user-phone').val();
          var user_check_1 = $('#user-check-1').is(':checked');
          var user_check_2 = $('#user-check-2').is(':checked');
          var user_message = $('#user-message').val();
          var prv_user_register_nonce = $('#prv-user-register-nonce').val();

          console.log(user_check_1);

          var reg = /(?:\(['"]?)(.*?)(?:['"]?\))/;
          var extracted_image = reg.exec(user_image)[1];

          $.ajax({
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
              user_check_1: user_check_1,
              user_check_2: user_check_2,
              user_message: user_message,
              prv_user_register_nonce: prv_user_register_nonce,
            },
            success: function(results) {
              //console.log(results);
              const element = $('.notice');

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
              const element = $('.notice');
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

      })(jQuery);
    </script>
<?php
    return ob_get_clean();
  }

  public function register_process()
  {

    if (isset($_POST["user_display_name"]) && wp_verify_nonce($_POST['prv_user_register_nonce'], 'prv-user-register-nonce')) {

      $user_login    = $_POST["user_display_name"];
      $user_email    = $_POST["user_email"];
      $user_first   = $_POST["user_first_name"];
      $user_last     = $_POST["user_last_name"];
      $user_pass    = $_POST["user_password"];
      $pass_confirm   = $_POST["user_password_repeat"];
      $user_image = $_POST["user_image"];
      $user_city = $_POST["user_city"];
      $user_district  = $_POST["user_district"];
      $user_school = $_POST["user_school"];
      $user_subject = $_POST["user_subject"];
      $user_phone = $_POST["user_phone"];
      $user_check_1 = $_POST["user_check_1"];
      $user_check_2 = $_POST["user_check_2"];
      $user_message = $_POST["user_message"];



      $error = [];


      // this is required for username checks
      require_once(ABSPATH . WPINC . '/registration.php');

      $user_image_handler = new PictureUpload($user_first, $user_last);

      $user_image_handler_result = $user_image_handler->check_valid_image($user_image);


      if (!empty($user_image_handler_result["error"])) {
        $error["error"][] = $user_image_handler_result["error"];
      }

      if (username_exists($user_login) && email_exists($user_email)) {
        $error["error"][] = "Bu mail adresi sistemde kayıtlı. Giriş yapıp işleminize devam edebilrisiniz.";
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
      if ($user_pass == '') {

        $error["error"][] = "Lütfen bir şifre giriniz.";
      }
      if ($user_pass != $pass_confirm) {
        // passwords do not match
        $error["error"][] = "Girdiğiniz şifre eşleşmiyor.";
      }

      if ($user_city == '' || $user_city == 'İl seçiniz...') {
        $error["error"][] = "Lütfen bir şehir seçiniz.";
      }

      if ($user_district == '' || $user_district == 'İlçe seçiniz...') {

        $error["error"][] = "Lütfen bir ilçe seçiniz.";
      }

      if ($user_school == '' || $user_school == 'Okul seçiniz...') {

        $error["error"][] = "Lütfen bir okul seçiniz.";
      }

      if ($user_subject == '' || $user_school == 'Branş seçiniz...') {

        $error["error"][] = "Lütfen bir branş seçiniz.";
      }

      $phone_pattern = '/^(05(\d{9}))$/';

      if ($user_phone == '' || !preg_match($phone_pattern, $user_phone)) {

        $error["error"][] = "Lütfen geçerli bir cep numarası giriniz. Örnek : 05xxxxxxxxx ";
      }

      if ($user_check_1 === "false") {

        $error["error"][] = "\"FORM ÜZERİNDE BİLGİLERİ EKSİKSİZ BİR ŞEKİLDE DOLDURDUM.\" butonlarını işaretlediğinizden emin olun.";
      }

      if ($user_check_2 === "false") {

        $error["error"][] = "\"İLETİŞİM BİLGİLERİM BENİMLE İLETİŞİME GEÇMEK İÇİN KULLANILABİLİR.\" butonlarını işaretlediğinizden emin olun.";
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

          $user_image_handler->save_image($new_user_id);
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
