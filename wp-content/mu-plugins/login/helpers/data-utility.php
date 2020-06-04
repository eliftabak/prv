<?php
class DataHandling
{
  private $file;
  private $json_file;

  public function __construct()
  {
    $this->file = dirname(__FILE__, 2) . "/data/schools.json";
    $this->json_file = $this->read_json_file();
  }

  private function read_json_file()
  {

    $file = file_get_contents($this->file);
    $file = json_decode($file, true);
    return $file;
  }

  public function get_cities()
  {

    $file =  $this->json_file;
    $cities = array();
    $previous_city = array();

    foreach ($file as $object) {

      $city = $object["city"];
      $cityId = $object["cityId"];

      $data = array(
        "city" => $city,
        "cityId" => $cityId
      );

      if ($data !== $previous_city) {

        $previous_city = $data;

        array_push($cities, $data);
      }
    }

    return $cities;
  }

  public function get_districts()
  {

    $file =  $this->json_file;
    $districts = array();
    $previous_data = array();

    foreach ($file as $object) {

      $city = $object["city"];
      $cityId = $object["cityId"];
      $district = $object["district"];
      $districtId = $object["districtId"];

      $data = array(
        "city" => $city,
        "cityId" => $cityId,
        "district" => $district,
        "districtId" => $districtId
      );

      if ($data !== $previous_data) {

        $previous_data = $data;

        array_push($districts, $data);
      }
    }

    return $districts;
  }

  public function get_schools()
  {

    $file =  $this->json_file;
    $schools = array();
    $previous_school = "";
    foreach ($file as $object) {

      $name = $object["name"];
      $cityId = $object["cityId"];
      $districtId = $object["districtId"];

      $data = array(
        "cityId" => $cityId,
        "districtId" => $districtId,
        "name" => $name
      );

      if ($data["name"] != $previous_school) {

        $previous_school = $data["name"];

        array_push($schools, $data);
      }
    }

    return $schools;
  }
}
