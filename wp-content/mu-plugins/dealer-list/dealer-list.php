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
    wp_enqueue_script('pollyfill', '//polyfill.io/v3/polyfill.min.js?features=default', array(), false, false);
    wp_enqueue_script('google_map', "//maps.googleapis.com/maps/api/js?key={$this->maps_api}&libraries=&v=weekly", array(), false, false);
    wp_enqueue_script('photoswipe-js', WP_PLUGIN_URL . '/woocommerce/assets/js/photoswipe/photoswipe.min.js', array(), false, false);
    wp_enqueue_script('photoswipe-ui-default-js', WP_PLUGIN_URL . '/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min.js', array(), false, false);
    wp_enqueue_script('bayi_script', WPMU_PLUGIN_URL . '/dealer-list/frontend/script.js', array(), false, false);
    wp_localize_script(
      'bayi_script',
      'php_vars',
      array(
        'site_name' => home_url(),
        'data' => $this->bayi_data(),
        'district_path' => home_url() .  $this->district_path,
      ),
    );

    //Styles
    wp_enqueue_style('photoswipe-css',  WP_PLUGIN_URL . '/woocommerce/assets/css/photoswipe/photoswipe.min.css', array(), false, false);
    wp_enqueue_style('photoswipe-ui-default-css',  WP_PLUGIN_URL . '/woocommerce/assets/css/photoswipe/default-skin/default-skin.min.css', array(), false, false);
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

    $query_args = array(
      'post_type'  => 'bayi_listesi',
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
          'lat' => $meta['prv_delar_shop_latitude'],
          'long' => $meta['prv_delar_shop_longitude'],
          'adress' => $meta['prv_delar_shop_full_adress'],
          'shop_phone' => $meta['prv_delar_shop_phone'],
          'cell_phone' => $meta['prv_delar_shop_cell_phone'],
          'pictures' => unserialize($meta['prv_delar_shop_pictures'][0]),
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
      <div class="col-lg-8">
        <div class="container-fluid pt-3">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="dealer-city">İl</label>
                <?php
                woocommerce_form_field('dealer-city', array(
                  'type'        => 'select',
                  'required'    => true,
                  'class' => ["akilli-tahta-uygulamalari__woocommerce-forms"],
                  'input_class' => ["form-control form-control-lg"],
                  'options' => $this->city_data(),
                ));
                ?>
                <div class="invalid-feedback">Bu alan doldurulması zorunludur.</div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="dealer-district">İlçe</label>
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
          </div>
        </div>
        <div id="bayi-map" class="bayi-map"></div>
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
      <div class="col-lg-4">
        <div class="bayi-pictures pt-3" style="display: none;"></div>
      </div>
    </div>
<?php
    return ob_get_clean();
  }
}

$dealer_list = DealerList::getInstance();
