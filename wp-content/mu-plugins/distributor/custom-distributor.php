<?php


require(dirname(__FILE__) . "/helpers/distributer-utility.php");


//TODO:Continue from here

class Distributer
{
  private $site_url;
  private $city_path = "/wp-json/prv_login/v1/cities";
  private $district_path = "/wp-json/prv_login/v1/districts";

  public function __construct()
  {
    add_action('wp_ajax_register_dealer', array($this, 'register_process'), 0);
    add_action('wp_ajax_nopriv_register_dealer', array($this, 'register_process'));
    add_shortcode('register_dealer_form', array($this, 'html_logic'));
    $this->site_url = site_url();
  }

  function html_logic()

  {

    if (isset($_COOKIE["prv_dealer_registered"]) && $_COOKIE["prv_dealer_registered"] == true) {
      return $this->success_html();
    } else {
      return $this->registration_form();
    }
  }

  function success_html()
  {
    ob_start(); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mb-5">Talebiniz değerlendiriliyor.</h1>
          <i class="fa fa-hourglass-end double-flash" style="font-size: 10rem;" aria-hidden="true"></i>
          <h3 class="text-info mt-5">En kısa zamanda dönüş yapılacaktır.</h3>
        </div>
      </div>
    </div>
  <?php
    return ob_get_clean();
  }

  function registration_form()
  {
    ob_start(); ?>
    <h3 class="text-center">Bayilik Başvuru Formu</h3>
    <div class="notice" style="display:none"></div>
    <div id="stepperFormBayi" class="bs-stepper linear">
      <div class="bs-stepper-header" role="tablist">
        <div class="step active" data-target="#test-form-1">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1" aria-selected="true">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label">Kişisel Bilgiler</span>
          </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-2">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label">Firma Bilgileri</span>
          </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-3">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label">Bayilik Bilgileri</span>
          </button>
        </div>
        <div class="bs-stepper-line"></div>
        <div class="step" data-target="#test-form-4">
          <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger4" aria-controls="test-form-4" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle">4</span>
            <span class="bs-stepper-label">Başvuruyu Tamamla</span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form class="needs-validation bayilik-talep-form" onsubmit="return false" novalidate="" action="#" method="POST" name="bayilik-talep-form">
          <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade active dstepper-block" aria-labelledby="stepperFormTrigger1">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <h5 class="bayilik-talep-form__subtitle">Kişisel bilgilerinizi giriniz.</h5>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="personel-email">E-Posta <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" id="personel-email" type="mail" name="personel-email" class="form-control" placeholder="Mail adresi giriniz" required data-cip-id="personel-email">
                        <div class="invalid-feedback">Geçerli bir mail adresi giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="personel-first-name">Ad <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$" id="personel-first-name" name="personel-first-name" type="text" class="form-control" placeholder="Adınızı giriniz" required data-cip-id="personel-first-name">
                        <div class="invalid-feedback">Geçerli bir isim giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="personel-last-name">Soyad <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$" id="personel-last-name" name="personel-last-name" type="text" class="form-control" placeholder="Soyadınızı giriniz" required data-cip-id="personel-last-name">
                        <div class="invalid-feedback">Geçerli bir soy isim giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="personel-phone">Telefon <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^(0([0-9])(\d{9}))$" id="personel-phone" name="personel-phone" type="text" class="form-control" placeholder="Kişisel telefon numaranızı giriniz" required data-cip-id="personel-phone">
                        <div class="invalid-feedback">Telefon numarası 0 ile başlamalı ve bitişik yazılmalıdır. <br> Toplam 11 hane olmalıdır.<br> Örneğin : 0**********</div>
                      </div>
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
                <div class="col-lg-12">
                  <h5 class="bayilik-talep-form__subtitle">Firma bilgilerinizi giriniz.</h5>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-name">Firma Ünvanı <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(.{10,})" id="company-name" name="company-name" type="text" class="form-control" placeholder="Firma ismini giriniz" required data-cip-id="company-name">
                        <div class="invalid-feedback">Minimum 10 karakter olmalıdır.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-phone">Telefon( Ofis ) <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^(0([0-9])(\d{9}))$" id="company-phone" name="company-phone" type="text" class="form-control" placeholder="Ofis telefon numarasını giriniz" required data-cip-id="company-phone">
                        <div class="invalid-feedback">Telefon numarası 0 ile başlamalı ve bitişik yazılmalıdır. <br> Toplam 11 hane olmalıdır.<br> Örneğin : 0**********</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-tax-office">Vergi Dairesi <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(^[A-Za-zğüşıöçĞÜŞİÖÇ]{2,})(.{0,}?)([A-Za-zğüşıöçĞÜŞİÖÇ]{2,})(.{0,}?)([A-Za-zğüşıöçĞÜŞİÖÇ]{2,}$)" id="company-tax-office" name="company-tax-office" type="text" class="form-control" placeholder="Bağlı olduğunuz vergi dairesini giriniz" required data-cip-id="company-tax-office">
                        <div class="invalid-feedback">Geçerli bir vergi dairesi ismi giriniz. Örneğin : Bolu Vergi Dairesi</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-tax-number">Vergi Numarası <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="^([0-9])(\d{9})$" id="company-tax-number" name="company-tax-number" type="text" class="form-control" placeholder="Vergi numaranızı giriniz" required data-cip-id="company-tax-number">
                        <div class="invalid-feedback">Geçerli bir vergi numarası giriniz. <br> Toplam 10 hane olmalıdır.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-city">İl <span class="text-danger font-weight-bold">*</span></label>
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
                        woocommerce_form_field('company-city', array(
                          'type'        => 'select',
                          'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                          'input_class' => ["form-control form-control-lg"],
                          'custom_attributes' => array("pattern" => "^((?!İl\sseçiniz\.\.\.).)*$"),
                          'options' => $data
                        ));
                        ?>
                        <div class="invalid-feedback">Lütfen il seçiniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="company-district">İlçe <span class="text-danger font-weight-bold">*</span></label>
                        <?php
                        woocommerce_form_field('company-district', array(
                          'type'        => 'select',
                          'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                          'select_class' => ["form-control form-control-lg"],
                          'placeholder' => 'Bir seçenek belirleyin..',
                          'custom_attributes' => array("pattern" => "^((?!İlçe\sseçiniz\.\.\.).)*$"),
                          'options' => array('' => 'İlçe seçiniz...')
                        ));
                        ?>
                        <div class="invalid-feedback">Lütfen ilçe seçiniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="company-adress">Adres <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(.{15,})" id="company-adress" type="text" name="company-adress" class="form-control" placeholder="Şirketinizin açık adresini giriniz" required data-cip-id="company-adress">
                        <div class="invalid-feedback">Minimum 15 karakter olmalıdır.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-right mt-5 d-flex justify-content-between">
                <button class="btn btn-info btn-lg shadow btn-previous-form d-inline-block">Önceki</button>
                <button class="btn btn-info btn-lg shadow btn-next-form d-inline-block">Sonraki</button>
              </div>
            </div>
          </div>
          <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger3">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <h5 class="bayilik-talep-form__subtitle">Bayilik talep edilen lokasyon ile ilgili bilgilerinizi giriniz.</h5>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="dealer-city">İl <span class="text-danger font-weight-bold">*</span></label>
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
                        woocommerce_form_field('dealer-city', array(
                          'type'        => 'select',
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
                        <label for="dealer-district">İlçe <span class="text-danger font-weight-bold">*</span></label>
                        <?php
                        woocommerce_form_field('dealer-district', array(
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
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="dealer-work-style">Çalışma şekli <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(.{15,})" id="dealer-work-style" name="dealer-work-style" type="text" class="form-control" placeholder="Çalışma şeklinizi giriniz" required data-cip-id="dealer-work-style">
                        <div class="invalid-feedback">Minumum 15 karakter giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="dealer-product-category">Ürün grupları <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(.{15,})" id="dealer-product-category" name="dealer-product-category" type="text" class="form-control" placeholder="Ağırlıklı çalıştığınız ürün grupları isimlerini giriniz" required data-cip-id="dealer-product-category">
                        <div class="invalid-feedback">Minumum 15 karakter giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="dealer-publishing">Yayınlar <span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="(.{15,})" id="dealer-publishing" type="text" name="dealer-publishing" class="form-control" placeholder="Bayiliğini halen yaptığınız yayınların isimlerini giriniz" required data-cip-id="dealer-publishing">
                        <div class="invalid-feedback">Minumum 15 karakter giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="dealer-field-personel">Personel sayısı<span class="text-danger font-weight-bold">*</span></label>
                        <input pattern="/\d{1,}" id="dealer-field-personel" type="number" name="dealer-field-personel" class="form-control" placeholder="Okul tanıtımı yapan aktif personel sayısını giriniz" required data-cip-id="dealer-field-personel">
                        <div class="invalid-feedback">Sadece sayı giriniz.</div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="dealer-history">Firma bilgisi <span class="text-danger font-weight-bold">*</span></label>
                        <textarea minlength="15" id="dealer-history" rows="2" name="dealer-history" class="form-control" placeholder="Firmanız kaç yıldır faaliyet gösteriyor? Firmanızdan kısaca bahsediniz. Varsa referanslarını yazınız." required data-cip-id="dealer-history"></textarea>
                        <div class="invalid-feedback">Minumum 15 karakter giriniz.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid text-right mt-5 d-flex justify-content-between">
                <button class="btn btn-info btn-lg shadow btn-previous-form d-inline-block">Önceki</button>
                <button class="btn btn-info btn-lg shadow btn-next-form d-inline-block">Sonraki</button>
              </div>
            </div>
          </div>
          <div id="test-form-4" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger4">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row no-gutters">
                    <h5 class="bayilik-talep-form__subtitle">Başvuruyu tamamla.</h5>
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
                  </div>
                </div>
              </div>
              <input type="hidden" name="prv_distributer_register_nonce" value="<?php echo wp_create_nonce('prv-distributer-register-nonce'); ?>" id="prv-distributer-register-nonce" />
              <div class="container-fluid text-right mt-5 d-flex justify-content-between">
                <button class="btn btn-info btn-lg shadow btn-previous-form d-inline-block">Önceki</button>
                <button type="submit" class="btn btn-success btn-lg shadow d-inline-block" id="bayilik-basvuru-submit"><i class="fa fa-paper-plane pr-2" aria-hidden="true"></i>Başvurumu Tamamla</button>
              </div>
              </>
            </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
      (function($) {


        const $companyCity = $('#company-city');
        const $dealerCity = $('#dealer-city');
        const $companyDistrict = $('#company-district');
        const $dealerDistrict = $('#dealer-district');

        function resetCompanyCity() {

          $companyCity.find("option").remove();

        }

        function resetCompanyDistrict() {

          $companyDistrict.find("option").remove();

        }


        function resetDelaerCity() {

          $dealerCity.find("option").remove();

        }

        function resetDelaerDistrict() {

          $dealerDistrict.find("option").remove();

        }

        function resetDistrict(district) {

          district.find("option").remove();

        }


        function getDistrictById(id, district) {
          const url = '<? echo "{$this->site_url}{$this->district_path}"  ?>' + `?city=${id}`;
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
            resetDistrict(district);
            district.append(districts);
          });
        }

        $companyCity.on('change', function() {

          const id = $(this).find("option").filter(':selected').val();

          getDistrictById(id, $companyDistrict);

        });

        $dealerCity.on('change', function() {

          const id = $(this).find("option").filter(':selected').val();

          getDistrictById(id, $dealerDistrict);

        });


        $('#bayilik-basvuru-submit').on('click', function(e) {

          e.preventDefault();
          var personel_email = $('#personel-email').val();
          var personel_first_name = $('#personel-first-name').val();
          var personel_last_name = $('#personel-last-name').val();
          var personel_phone = $('#personel-phone').val();
          var company_name = $('#company-name').val();
          var company_phone = $('#company-phone').val();
          var company_tax_office = $('#company-tax-office').val();
          var company_tax_number = $('#company-tax-number').val();
          var company_city = $('#company-city option:selected').text();
          var company_district = $('#company-district option:selected').text();
          var company_adress = $('#company-adress').val();
          var dealer_city = $('#dealer-city option:selected').text();
          var dealer_district = $('#dealer-district option:selected').text();
          var dealer_work_style = $('#dealer-work-style').val();
          var dealer_product_category = $('#dealer-product-category').val();
          var dealer_publishing = $('#dealer-publishing').val();
          var dealer_field_personel = $('#dealer-field-personel').val();
          var dealer_history = $('#dealer-history').val();
          var user_check_1 = $('#user-check-1').is(':checked');
          var user_check_2 = $('#user-check-2').is(':checked');
          var user_message = $('#user-message').val();
          var prv_distributer_register_nonce = $('#prv-distributer-register-nonce').val();

          $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
              action: "register_dealer",
              personel_email: personel_email,
              personel_first_name: personel_first_name,
              personel_last_name: personel_last_name,
              personel_phone: personel_phone,
              company_name: company_name,
              company_phone: company_phone,
              company_tax_office: company_tax_office,
              company_tax_number: company_tax_number,
              company_city: company_city,
              company_district: company_district,
              company_adress: company_adress,
              dealer_city: dealer_city,
              dealer_district: dealer_district,
              dealer_work_style: dealer_work_style,
              dealer_product_category: dealer_product_category,
              dealer_publishing: dealer_publishing,
              dealer_field_personel: dealer_field_personel,
              dealer_history: dealer_history,
              user_check_1: user_check_1,
              user_check_2: user_check_2,
              user_message: user_message,
              prv_distributer_register_nonce: prv_distributer_register_nonce,
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

  function register_process()
  {
    if (isset($_POST["personel_email"]) && wp_verify_nonce($_POST['prv_distributer_register_nonce'], 'prv-distributer-register-nonce')) {

      $personel_email = $_POST["personel_email"];
      $personel_first_name  = $_POST["personel_first_name"];
      $personel_last_name = $_POST["personel_last_name"];
      $personel_phone  = $_POST["personel_phone"];
      $company_name  = $_POST["company_name"];
      $company_phone = $_POST["company_phone"];
      $company_tax_office  = $_POST["company_tax_office"];
      $company_tax_number  = $_POST["company_tax_number"];
      $company_city  = $_POST["company_city"];
      $company_district  = $_POST["company_district"];
      $company_adress  = $_POST["company_adress"];
      $dealer_city  = $_POST["dealer_city"];
      $dealer_district  = $_POST["dealer_district"];
      $dealer_work_style  = $_POST["dealer_work_style"];
      $dealer_product_category  = $_POST["dealer_product_category"];
      $dealer_publishing  = $_POST["dealer_publishing"];
      $dealer_field_personel  = $_POST["dealer_field_personel"];
      $dealer_history  = $_POST["dealer_history"];
      $user_check_1 = $_POST["user_check_1"];
      $user_check_2 = $_POST["user_check_2"];
      $user_message = $_POST["user_message"];



      $error = [];

      if ($personel_email == '') {
        $error["error"][] = "Lütfen bir mail adresi giriniz.";
      }
      if (!is_email($personel_email)) {
        $error["error"][] = "Geçerli bir e-posta adresi giriniz.";
      }
      if ($personel_first_name == '') {
        $error["error"][] = "Lütfen bir isim adı giriniz.";
      }
      if (!validate_username($personel_first_name)) {
        $error["error"][] = "Geçersiz kullanıcı adı giriniz.";
      }
      if ($personel_last_name == '') {
        $error["error"][] = "Lütfen bir soyisim giriniz.";
      }
      if ($personel_phone == '') {
        $error["error"][] = "Lütfen bir telefon numarası giriniz.";
      }
      if ($company_name == '') {
        $error["error"][] = "Lütfen şirket ismini giriniz.";
      }
      if ($company_phone == '') {
        $error["error"][] = "Lütfen bir şirket telefonu giriniz.";
      }
      if ($company_tax_office == '') {
        $error["error"][] = "Lütfen şirketiniz bağlı olduğunu vergi dairesi ismini giriniz.";
      }
      if ($company_tax_number == '') {
        $error["error"][] = "Lütfen şirketinizin vegi numarasını giriniz.";
      }
      if ($company_city == '') {
        $error["error"][] = "Lütfen şirketinizin bulduğu il ismini giriniz.";
      }
      if ($company_district == '') {
        $error["error"][] = "Lütfen şirketinizin bulduğu ilçe ismini giriniz.";
      }
      if ($company_adress == '') {
        $error["error"][] = "Lütfen şirketinizin adresini giriniz.";
      }
      if ($dealer_city == '') {
        $error["error"][] = "Lütfen bayilik talep ettiğiniz il ismini giriniz.";
      }
      if ($dealer_district  == '') {
        $error["error"][] = "Lütfen bayilik talep ettiğiniz ilçe veya ilçeler'i giriniz.";
      }
      if ($dealer_work_style == '') {
        $error["error"][] = "Lütfen çalışma şeklinizi girinizs.";
      }
      if ($dealer_product_category == '') {
        $error["error"][] = "Lütfen ürün grublarını giriniz.";
      }
      if ($dealer_publishing == '') {
        $error["error"][] = "Lütfen hali hazırda bayiliğini yapmakta olduğunuz yayınları girinizs.";
      }
      if ($dealer_field_personel == '') {
        $error["error"][] = "Lütfen sahada çalışan personel sayısını giriniz.";
      }
      if ($dealer_history == '') {
        $error["error"][] = "Lütfen firmanız hakkında kısa tanıtım bilgisi giriniz.";
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

        $args = array(
          "personel_email" => $personel_email,
          "personel_first_name" => $personel_first_name,
          "personel_last_name" => $personel_last_name,
          "personel_phone" => $personel_phone,
          "company_name" => $company_name,
          "company_phone" => $company_phone,
          "company_tax_office" => $company_tax_office,
          "company_tax_number" => $company_tax_number,
          "company_city" => $company_city,
          "company_district" => $company_district,
          "company_adress" => $company_adress,
          "dealer_city" => $dealer_city,
          "dealer_district" => $dealer_district,
          "dealer_work_style" => $dealer_work_style,
          "dealer_product_category" => $dealer_product_category,
          "dealer_publishing" => $dealer_publishing,
          "dealer_field_personel" => $dealer_field_personel,
          "dealer_history" => $dealer_history,
        );

        // send an email to the admin alerting them of the registration
        notify_admin_for_new_dealer_register($args, $user_message);

        // send an email to the admin alerting them of the registration
        send_welcome_email_to_distributer($args);

        $cookie_path = str_replace("/wp-admin/admin-ajax.php", "/", $_SERVER['REQUEST_URI']);

        if (!isset($_COOKIE["prv_dealer_registered"])) {
          setcookie("prv_dealer_registered", true, time() + 2629746,  $cookie_path, $_SERVER['HTTP_HOST']);
        };

        $data["success"][] = "Talebiniz başarıyla tarafımıza ulaşmıştır.";
        wp_send_json_success($data, 200);
      }
    } else {
      wp_die();
    }
  }
}


new Distributer();
