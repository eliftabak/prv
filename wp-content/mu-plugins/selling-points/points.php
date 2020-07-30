<?php

class SellPoints
{
  private static $instance = null;
  public $js_name = "sell_points_admin_js";
  private $city_path = "/wp-json/prv_login/v1/cities";
  private $district_path = "/wp-json/prv_login/v1/districts";
  public function __construct()
  {
    $this->register_wordpress_actions();
  }
  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new SellPoints();
    }

    return self::$instance;
  }

  private function register_wordpress_actions()
  {
    add_action('template_redirect', array($this, 'bayi_data'));
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
    add_shortcode('bayilik_listesi', array($this, 'html'));
  }


  public function frontend_scripts()
  {

    $page = is_page("satis-noktalari");

    if (!$page) {
      return;
    }

    //Scripts
    wp_enqueue_script('photo-gallery-js', WPMU_PLUGIN_URL . '/selling-points/vendor/svg-map/js/photoGallery.js', array("jquery"), [], false);
    wp_enqueue_script('svg-map-js', WPMU_PLUGIN_URL . '/selling-points/vendor/svg-map/js/mapLoader.js', array("jquery"), [], false);
    wp_enqueue_script('photoswipe-js', WP_PLUGIN_URL . '/woocommerce/assets/js/photoswipe/photoswipe.min.js', array(), false, false);
    wp_enqueue_script('photoswipe-ui-default-js', WP_PLUGIN_URL . '/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js', array(), false, false);
    wp_enqueue_script('bayi_script', WPMU_PLUGIN_URL . '/selling-points/frontend/js/script.js', array('jquery'), '1.0', true);
    wp_localize_script(
      'bayi_script',
      'php_vars',
      array(
        'WPMU_PLUGIN_URL' => WPMU_PLUGIN_URL,
        'site_name' => home_url(),
        'data' => $this->bayi_data(),
        'district_path' => home_url() .  $this->district_path,
      ),
    );


    //Styles
    wp_enqueue_style('svg-map-css',  WPMU_PLUGIN_URL . '/selling-points/vendor/svg-map/css/map.css', array(), false, false);
    wp_enqueue_style('photoswipe-css',  WP_PLUGIN_URL . '/woocommerce/assets/css/photoswipe/photoswipe.min.css', array(), false, false);
    wp_enqueue_style('photoswipe-ui-default-css',  WP_PLUGIN_URL . '/woocommerce/assets/css/photoswipe/default-skin/default-skin.min.css', array(), false, false);
    wp_enqueue_style('main-css',  WPMU_PLUGIN_URL . '/selling-points/frontend/css/main.css', array(), false, false);
  }

  public function admin_scripts()
  {

    $screen = get_current_screen();

    if ($screen->base !== "post"  && $screen->post_type !== "bayi_listesi") {
      return;
    }
    wp_register_script($this->js_name, WPMU_PLUGIN_URL . '/selling-points/admin/js/scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script($this->js_name);
    wp_localize_script(
      $this->js_name,
      'php_vars',
      array(
        'site_name' => home_url(),
        'city_path' => $this->city_path,
        'district_path' => $this->district_path,
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

  public function bayi_data()
  {

    $page = is_page("satis-noktalari");

    if (!$page) {
      return;
    }

    $query_args = array(
      'post_type'  => 'bayi_listesi',
      'posts_per_page' => -1,
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key'   => 'prv_delar_shop_phone',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_delar_shop_cell_phone',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_delar_shop_latitude',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_delar_shop_longitude',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_dealer_shop_city',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_dealer_shop_district',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_delar_shop_full_adress',
          'compare' => 'EXIST'
        ),
        array(
          'key'   => 'prv_delar_shop_pictures',
          'compare' => 'EXIST'
        ),
      )
    );

    $query = new WP_Query($query_args);
    $data = [];
    $index = 0;
    if ($query->have_posts()) : while ($query->have_posts()) :
        $query->the_post();
        $meta = get_post_meta($query->post->ID);
        $item = array(
          'title' => $query->post->post_title,
          'city' => !empty($meta['prv_dealer_shop_city']) ? $meta['prv_dealer_shop_city'] : "",
          'district' => !empty($meta['prv_dealer_shop_district']) ? $meta['prv_dealer_shop_district'] : "",
          'lat' => !empty($meta['prv_delar_shop_latitude']) ? $meta['prv_delar_shop_latitude'] : "",
          'long' => !empty($meta['prv_delar_shop_longitude']) ? $meta['prv_delar_shop_longitude'] : "",
          'adress' => !empty($meta['prv_delar_shop_full_adress']) ? $meta['prv_delar_shop_full_adress'] : "",
          'about' => !empty($meta['prv_delar_shop_about']) ? $meta['prv_delar_shop_about'] : "",
          'cell_phone' => !empty($meta['prv_delar_shop_cell_phone']) ? $meta['prv_delar_shop_cell_phone'] : "",
          'pictures' => !empty(isset($meta['prv_delar_shop_pictures'][0])) ? unserialize($meta['prv_delar_shop_pictures'][0]) : "",
        );
        array_push($data, $item);
        $index++;
      endwhile;
      wp_reset_postdata();
    endif;
    return $data;
  }

  public function html()
  {

    ob_start()
?>
    <div class="row no-gutters">
      <div class="bayi-container col-lg-12">
        <div id="bayi-map" class="bayi-map h-100 w-100 pt-lg-5 pb-lg-5 text-center"></div>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="pswp__bg"></div>
          <div class="pswp__scroll-wrap">
            <div class="pswp__container">
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
              <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                  <div class="pswp__preloader__icn">
                    <div class="pswp__preloader__cut">
                      <div class="pswp__preloader__donut"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
              </div>
              <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
              </button>
              <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
              </button>
              <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 h-100">
        <div class="bayi-info pt-3" style="display: none;"></div>
        <div class="bayi-pictures pt-3" style="display: none;"></div>
      </div>
    </div>
<?php
    return ob_get_clean();
  }
}

$sell_points = SellPoints::getInstance();
