<?php


class DealerList
{
  public $js_name = "delar_list_admin_js";
  private $city_path = "/wp-json/prv_login/v1/cities";
  private $district_path = "/wp-json/prv_login/v1/districts";
  private $maps_api = "AIzaSyCczNQVFBJL6MH6mXVzPEAwY0_Vwbn5iMQ";
  private static $instance = null;

  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new DealerList();
    }

    return self::$instance;
  }

  public function __construct()
  {
    $this->register_wordpress_actions();
  }

  private function register_wordpress_actions()
  {
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
    add_shortcode('bayilik_listesi', array($this, 'html'));
  }

  public function frontend_scripts()
  {
    global $wp_scripts;

    $page = is_page("satis-noktalari");

    if (!$page) {
      return;
    }
    wp_enqueue_script('pollyfill', '//polyfill.io/v3/polyfill.min.js?features=default', array(), false, false);
    wp_enqueue_script('google_map', "//maps.googleapis.com/maps/api/js?key={$this->maps_api}&libraries=&v=weekly", array(), false, false);
    $wp_scripts->add_data('google_map', 'id', 'wotttt');
  }

  public function admin_scripts()
  {

    $screen = get_current_screen();

    if ($screen->base !== "post"  && $screen->post_type !== "bayi_listesi") {
      return;
    }

    wp_register_script($this->js_name, WPMU_PLUGIN_URL . '/dealer-list/admin/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script($this->js_name);
    wp_localize_script(
      $this->js_name,
      'php_vars',
      array(
        'site_name' => home_url(),
        'city_path' => $this->city_path,
        'district_path' => $this->district_path
      )
    );
  }
  public function city_data()
  {
    $city_url = home_url() . $this->city_path;
    $request_response = file_get_contents($city_url);
    $cities = json_decode($request_response, true);
    $cities = [["city_id" => "", "name" => "İl seçiniz..."], ...$cities];
    foreach ($cities as $value) {
      $id = $value["city_id"];
      $city = $value["name"];
      $city_data[$id] = $city;
    };
    return $city_data;
  }

  public function district_data()
  {

    if (!isset($_GET['post'])) {
      return;
    }
    $post_id = $_GET['post'];
    $city_id = get_post_meta($post_id, 'prv_dealer_shop_city', true);
    $district_url = home_url() . "{$this->district_path}?city={$city_id}";
    $request_response = file_get_contents($district_url);
    $cities = json_decode($request_response, true);
    $cities = [["district_id" => "", "name" => "İlçe seçiniz..."], ...$cities];
    foreach ($cities as $value) {
      $id = $value["district_id"];
      $district = $value["name"];
      $district_data[$id] = $district;
    };
    return $district_data;
  }

  public function html()
  {
    ob_start()
?>
    <div class="row no-gutters">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-10">
        <div id="bayi-map" class="bayi-map"></div>
        <div class="bayi-pictures"></div>
      </div>
    </div>
<?php
    return ob_get_clean();
  }
}

$dealer_list = DealerList::getInstance();
