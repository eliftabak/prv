<?php


//TODO: Continue from here


require(dirname(__FILE__) . "/data-utility.php");

class DatabaseHandling
{

  protected $wpdb;
  protected $db_name;
  protected $city_table_name;
  protected $district_table_name;
  protected $school_table_name;
  protected $data;
  public $option_name;

  public function __construct()
  {
    global $wpdb;

    $this->wpdb = &$wpdb;
    $this->db_name = "prv_login";
    $this->option_name = $this->db_name . "_db_version";
    $this->city_table_name = $this->wpdb->base_prefix . $this->db_name . "_cities";
    $this->district_table_name = $this->wpdb->base_prefix .  $this->db_name . "_districts";
    $this->school_table_name = $this->wpdb->base_prefix . $this->db_name . "_schools";
    $this->data = new DataHandling();
  }

  public function cretate_dbs()
  {


    if (
      $this->city_table() &&

      $this->districts_table() &&

      $this->shchools_table()
    ) {
      add_option($this->option_name, "1.0", "", false);
    } else {
      return false;
    }
  }


  private function city_table()
  {
    $charset_collate = $this->wpdb->get_charset_collate();

    $sql = "CREATE TABLE $this->city_table_name (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      city_id INT(3) UNSIGNED NOT NULL,
      name TINYTEXT NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $this->wpdb->query($sql);

    $success = empty($this->wpdb->last_error);

    return $success;
  }

  private function districts_table()
  {

    $charset_collate = $this->wpdb->get_charset_collate();

    $sql = "CREATE TABLE $this->district_table_name (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      district_id INT(3) UNSIGNED NOT NULL,
      city_id INT(3) UNSIGNED NOT NULL REFERENCES $this->city_table_name(city_id),
      name TINYTEXT NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $this->wpdb->query($sql);

    $success = empty($this->wpdb->last_error);

    return $success;
  }

  private function shchools_table()
  {

    $charset_collate = $this->wpdb->get_charset_collate();

    $sql = "CREATE TABLE $this->school_table_name  (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      city_id INT( 3 ) UNSIGNED NOT NULL REFERENCES $this->city_table_name(city_id),
      district_id INT( 3 ) UNSIGNED NOT NULL REFERENCES $this->district_table_name (district_id),
      name TINYTEXT NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $this->wpdb->query($sql);

    $success = empty($this->wpdb->last_error);

    return $success;
  }


  public function check_db_exist()
  {
    if (empty(get_site_option($this->option_name))) {
      return false;
    } else {
      return true;
    }
  }

  public function instert_datas()
  {

    $this->insert_cities();
    $this->insert_districts();
    $this->insert_schools();
  }

  private function insert_cities()
  {

    $cities = $this->data->get_cities();

    //print_r($cities);

    foreach ($cities as $value) {
      $this->wpdb->insert(
        $this->city_table_name,
        array(
          'city_id' => $value["cityId"],
          'name' => $value["city"]
        )
      );
    }
  }

  private function insert_districts()
  {

    $districts = $this->data->get_districts();

    //print_r($cities);

    foreach ($districts as $value) {
      $this->wpdb->insert(
        $this->district_table_name,
        array(
          'city_id' => $value["cityId"],
          'district_id' => $value["districtId"],
          'name' => $value["district"]
        )
      );
    }
  }

  private function insert_schools()
  {

    $schools = $this->data->get_schools();

    //print_r($cities);

    foreach ($schools as $value) {
      $this->wpdb->insert(
        $this->school_table_name,
        array(
          'city_id' => $value["cityId"],
          'district_id' => $value["districtId"],
          'name' => $value["name"]
        )
      );
    }
  }
}
