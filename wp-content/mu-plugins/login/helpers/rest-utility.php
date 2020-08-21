<?php


class RestRoutes
{
  private $wpdb;
  private $db;
  public $route_namescape = "prv_login/v1";

  public function __construct($db)
  {
    global $wpdb;
    $this->wpdb = &$wpdb;
    $this->db = $db;
  }


  public function  load_all_routes()
  {
    $this->city_actions();
    $this->district_actions();
    $this->schools_actions();
  }

  private function city_actions()
  {
    add_action('rest_api_init', function () {
      register_rest_route($this->route_namescape, 'cities', array(
        'methods' => 'GET',
        'callback' => array($this, 'get_all_cities'),
        'permission_callback' => '__return_true',
      ));
    });
  }

  private function district_actions()
  {
    add_action('rest_api_init', function () {
      register_rest_route($this->route_namescape, 'districts', array(
        'methods' => 'GET',
        'callback' => array($this, 'district_route'),
        'permission_callback' => '__return_true',
      ));
    });
  }


  private function schools_actions()
  {
    add_action('rest_api_init', function () {
      register_rest_route($this->route_namescape, 'schools', array(
        'methods' => 'GET',
        'callback' => array($this, 'schools_route'),
        'permission_callback' => '__return_true',
      ));
    });
  }

  public function schools_route($request)
  {

    $city_id = $request->get_param("city");
    $district_id = $request->get_param("district");

    if (!empty($city_id) && !empty($district_id)) {
      return $this->get_schools_by_ids($city_id, $district_id);
    } else {
      return $this->get_all_schools();
    }
  }


  public function district_route($request)
  {

    $city_id = $request->get_param("city");
    $district_name = $request->get_param("name");

    if (!empty($city_id) && !empty($district_name)) {
      return $this->get_districts_by_name($district_name, $city_id);
    } elseif (!empty($city_id)) {
      return $this->get_districts_by_city_id($city_id);
    } else {
      return $this->get_all_districts();
    }
  }


  public function get_all_cities()
  {

    $query = "SELECT * FROM {$this->db->city_table_name} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }



  private function get_all_districts()
  {

    $query = "SELECT * FROM {$this->db->district_table_name} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }

  private function get_districts_by_city_id($city_id)
  {
    $query = "SELECT * FROM {$this->db->district_table_name} WHERE city_id={$city_id} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }


  private function get_districts_by_name($district_name, $city_id)
  {
    $query = "SELECT * FROM {$this->db->district_table_name} WHERE name={$district_name} AND city_id={$city_id} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }



  private function get_all_schools()
  {

    $query = "SELECT * FROM {$this->db->school_table_name} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }


  private function get_schools_by_ids($city_id, $district_id)
  {
    $query = "SELECT * FROM {$this->db->school_table_name} WHERE city_id={$city_id} AND district_id={$district_id} ORDER BY name ASC";

    $results  = $this->wpdb->get_results($query, ARRAY_A);

    if (empty($results)) {
      return null;
    }
    return $results;
  }
}
