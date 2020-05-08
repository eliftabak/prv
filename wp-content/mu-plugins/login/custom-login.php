<?php


//TODO:Resume from here

class StepLogin
{

  public function __construct()
  {

    add_action('init', array($this, 'pippin_register_css'));
    add_action('wp_footer', array($this, 'pippin_print_css'));
    add_shortcode('register_form', array($this, 'pippin_registration_form'));
    add_shortcode('login_form', array($this, 'pippin_login_form'));
    add_action('init', array($this, 'pippin_login_member'));
    add_action('init', array($this, 'pippin_add_new_member'));
  }

  // register our form css
  function pippin_register_css()
  {

    //wp_register_style('pippin-form-vendor-css', plugin_dir_url(__FILE__) . 'vendor/stepper/stepper.min.css');
    //wp_register_script('pippin-form-vendor-js', plugin_dir_url(__FILE__) . 'vendor/stepper/stepper.min.js', ['jquery']);
    wp_register_style('pippin-form-css', plugin_dir_url(__FILE__) . 'app.css');
    //wp_register_script('pippin-form-js', plugin_dir_url(__FILE__) . 'app.js', ['jquery']);
  }

  // load our form css
  function pippin_print_css()
  {
    global $pippin_load_css;

    // this variable is set to TRUE if the short code is used on a page/post
    if (!$pippin_load_css)
      return; // this means that neither short code is prestyleent, so we get out of here

    //wp_print_styles('pippin-form-vendor-css');
    wp_print_styles('pippin-form-css');
    //wp_print_scripts('pippin-form-vendor-js');
    //wp_print_scripts('pippin-form-js');
  }


  // displays error messages from form submissions
  function pippin_show_error_messages()
  {
    if ($codes = $this->pippin_errors()->get_error_codes()) {
      echo '<div class="pippin_errors">';
      // Loop error codes and display errors
      foreach ($codes as $code) {
        $message = $this->pippin_errors()->get_error_message($code);
        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
      }
      echo '</div>';
    }
  }

  // used for tracking error messages
  function pippin_errors()
  {
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
  }

  // registration form fields
  function pippin_registration_form_fields()
  {

    ob_start(); ?>
    <h3 class="text-center"><?php _e('Talep Formu'); ?></h3>

    <?php
    $this->pippin_show_error_messages(); ?>

    <div id="stepperForm" class="bs-stepper linear">
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
            <span class="bs-stepper-label">Onay</span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form class="needs-validation pippin_form" onsubmit="return false" novalidate="" id="pippin_registration_form" action="" method="POST">
          <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade active dstepper-block" aria-labelledby="stepperFormTrigger1">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-12 no-gutters">
                  <div class="row justify-content-center">
                    <div class="col-sm-4 imgUp">
                      <div class="imagePreview"></div>
                      <label class="btn btn-primary">
                        Öğretmen Kimliğinizi Yükleyin
                        <input required type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                        <div class="invalid-feedback">Lütfen bir fotoğraf yükleyiniz.</div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 no-gutters">
                  <div class="row justify-content-center">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="inputMailForm">E-Posta adresiniz <span class="text-danger font-weight-bold">*</span></label>
                        <input id="inputMailForm" type="email" class="form-control" placeholder="Mail adresi giriniz" required data-cip-id="inputMailForm">
                        <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="inputMailForm">Adınız <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="inputMailForm">Soyadınız <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control" placeholder="Soyadınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="inputMailForm">Şifre <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="password" class="form-control" placeholder="Şifrenizi giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="inputMailForm">Şifre Tekrar <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="password" class="form-control" placeholder="Tekrar şifrenizi giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
              </div>
              <button class="btn btn-info btn-next-form d-inline-block">Sonraki</button>
            </div>
          </div>
          <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade dstepper-none" aria-labelledby="stepperFormTrigger2">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputMailForm">İl <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputMailForm">İlçe <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="inputMailForm">Okul <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputMailForm">Branş <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputMailForm">Telefon <span class="text-danger font-weight-bold">*</span></label>
                    <input id="inputMailForm" type="text" class="form-control form-control-lg" placeholder="Adınızı giriniz" required data-cip-id="inputMailForm">
                    <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
                  </div>
                </div>
              </div>
              <button class="btn btn-info btn-previous-form d-inline-block">Önceki</button>
              <button class="btn btn-info btn-next-form d-inline-block">Sonraki</button>
            </div>
          </div>
          <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center dstepper-none" aria-labelledby="stepperFormTrigger3">
            <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>" />
            <button type="submit" class="btn btn-primary mt-5">Submit</button>
          </div>
        </form>
      </div>
    </div>


  <?php
    return ob_get_clean();
  }

  // user registration login form
  function pippin_registration_form()
  {

    // only show the registration form to non-logged-in members
    if (!is_user_logged_in()) {

      global $pippin_load_css;

      // set this to true so the CSS is loaded
      $pippin_load_css = true;

      // check to make sure user registration is enabled
      $registration_enabled = get_option('users_can_register');

      // only show the registration form if allowed
      if ($registration_enabled) {
        $output = $this->pippin_registration_form_fields();
      } else {
        $output = __('User registration is not enabled');
      }
      return $output;
    }
  }



  // login form fields
  function pippin_login_form_fields()
  {

    ob_start(); ?>
    <h3 class="pippin_header"><?php _e('Login'); ?></h3>

    <?php
    // show any error messages after form submission
    $this->pippin_show_error_messages(); ?>

    <form id="pippin_login_form" class="pippin_form" action="" method="post">
      <fieldset>
        <p>
          <label for="pippin_user_Login">Username</label>
          <input name="pippin_user_login" id="pippin_user_login" class="required" type="text" />
        </p>
        <p>
          <label for="pippin_user_pass">Password</label>
          <input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password" />
        </p>
        <p>
          <input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>" />
          <input id="pippin_login_submit" type="submit" value="Login" />
        </p>
      </fieldset>
    </form>
<?php
    return ob_get_clean();
  }


  // user login form
  function pippin_login_form()
  {

    if (!is_user_logged_in()) {

      global $pippin_load_css;

      // set this to true so the CSS is loaded
      $pippin_load_css = true;

      $output = $this->pippin_login_form_fields();
    } else {
      // could show some logged in user info here
      // $output = 'user info here';
    }
    return $output;
  }



  // logs a member in after submitting a form
  function pippin_login_member()
  {

    if (isset($_POST['pippin_user_login']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {

      // this returns the user ID and other info from the user name
      $user = get_userdatabylogin($_POST['pippin_user_login']);

      if (!$user) {
        // if the user name doesn't exist
        $this->pippin_errors()->add('empty_username', __('Invalid username'));
      }

      if (!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
        // if no password was entered
        $this->pippin_errors()->add('empty_password', __('Please enter a password'));
      }

      // check the user's login with their password
      if (!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
        // if the password is incorrect for the specified user
        $this->pippin_errors()->add('empty_password', __('Incorrect password'));
      }

      // retrieve all error messages
      $errors = $this->pippin_errors()->get_error_messages();

      // only log the user in if there are no errors
      if (empty($errors)) {

        wp_setcookie($_POST['pippin_user_login'], $_POST['pippin_user_pass'], true);
        wp_set_current_user($user->ID, $_POST['pippin_user_login']);
        do_action('wp_login', $_POST['pippin_user_login']);

        wp_redirect(home_url());
        exit;
      }
    }
  }



  // register a new user
  function pippin_add_new_member()
  {
    if (isset($_POST["pippin_user_login"]) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
      $user_login    = $_POST["pippin_user_login"];
      $user_email    = $_POST["pippin_user_email"];
      $user_first   = $_POST["pippin_user_first"];
      $user_last     = $_POST["pippin_user_last"];
      $user_pass    = $_POST["pippin_user_pass"];
      $pass_confirm   = $_POST["pippin_user_pass_confirm"];

      // this is required for username checks
      require_once(ABSPATH . WPINC . '/registration.php');

      if (username_exists($user_login)) {
        // Username already registered
        $this->pippin_errors()->add('username_unavailable', __('Username already taken'));
      }
      if (!validate_username($user_login)) {
        // invalid username
        $this->pippin_errors()->add('username_invalid', __('Invalid username'));
      }
      if ($user_login == '') {
        // empty username
        $this->pippin_errors()->add('username_empty', __('Please enter a username'));
      }
      if (!is_email($user_email)) {
        //invalid email
        $this->pippin_errors()->add('email_invalid', __('Invalid email'));
      }
      if (email_exists($user_email)) {
        //Email address already registered
        $this->pippin_errors()->add('email_used', __('Email already registered'));
      }
      if ($user_pass == '') {
        // passwords do not match
        $this->pippin_errors()->add('password_empty', __('Please enter a password'));
      }
      if ($user_pass != $pass_confirm) {
        // passwords do not match
        $this->pippin_errors()->add('password_mismatch', __('Passwords do not match'));
      }

      $errors = $this->pippin_errors()->get_error_messages();

      // only create the user in if there are no errors
      if (empty($errors)) {

        $new_user_id = wp_insert_user(
          array(
            'user_login'    => $user_login,
            'user_pass'       => $user_pass,
            'user_email'    => $user_email,
            'first_name'    => $user_first,
            'last_name'      => $user_last,
            'user_registered'  => date('Y-m-d H:i:s'),
            'role'        => 'subscriber'
          )
        );
        if ($new_user_id) {
          // send an email to the admin alerting them of the registration
          wp_new_user_notification($new_user_id);

          // log the new user in
          wp_setcookie($user_login, $user_pass, true);
          wp_set_current_user($new_user_id, $user_login);
          do_action('wp_login', $user_login);

          // send the newly created user to the home page after logging them in
          wp_redirect(home_url());
          exit;
        }
      }
    }
  }
}

new StepLogin();
