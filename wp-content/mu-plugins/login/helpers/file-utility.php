<?php

class PictureUpload
{

  private $allowed_mimes;
  private $user_image;
  private $user_image_type;
  private $hashed_filename;
  public $firstname;
  public $lastname;

  public function __construct($firstname, $lastname)
  {
    $this->wp_upload_dir  = wp_upload_dir();
    $this->allowed_mimes = array(
      "jpe" => "image/jpeg",
      "jpeg" => "image/jpeg",
      "jpg" => "image/jpeg",
      "gif" => "image/gif",
      "png" => "image/png",
    );
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function check_valid_image($user_image)
  {

    $error = [];
    if (preg_match('/^data:image\/(\w+);base64,/', $user_image, $type)) {
      $user_image = substr($user_image, strpos($user_image, ',') + 1);
      $user_image_type = strtolower($type[1]); // jpg, png, gif

      if (!in_array($user_image_type, array_keys($this->allowed_mimes))) {
        $error["error"][] = 'Jpeg, gif  veya png formatlarından birini yükleyiniz. ';
        return $error;
      }

      $user_image = base64_decode($user_image);

      if ($user_image === false) {
        $error["error"][] = 'Resim işlenirken hata verdi.';
        return $error;
      }
    } else {
      $error["error"][] = 'Başka bir resim deneyerek tekrar yüklemeyi deneyiniz.';
      return $error;
    }

    $this->user_image = $user_image;

    $this->user_image_type = $user_image_type;
  }
  private function save_temporary()
  {

    return file_put_contents($this->get_temp_name_with_path(), $this->user_image);
  }

  private function get_temp_name_with_path()
  {

    $temp_name = WP_TEMP_DIR . $this->hashed_filename();

    return $temp_name;
  }

  private function get_sanitazed_file_name()
  {

    $fullname = $this->firstname . "_" . $this->lastname;

    $file_name = sanitize_title($fullname);

    return $file_name;
  }


  private function get_file_title()
  {

    $file_title = $this->firstname . " " . $this->lastname . " isimli öğretmenin kimliği";

    return $file_title;
  }

  private function hashed_filename()
  {

    if (empty($this->hashed_filename)) {
      $this->hashed_filename   = md5($this->get_sanitazed_file_name() . microtime()) . '_' . $this->get_sanitazed_file_name() . ".{$this->user_image_type}";
    }
    return  $this->hashed_filename;
  }

  private function get_temp_image_url()
  {
    $url = content_url(WP_TEMP_NAME) . "/" . $this->hashed_filename();

    return $url;
  }


  private function delete_temp_file()
  {

    $file  = $this->get_temp_name_with_path();

    if (is_file($file)) {
      unlink($file);
    }
  }


  private function create_attachment()
  {

    $url     = $this->get_temp_image_url();
    $desc    = $this->get_file_title();
    $parent_id = null;
    return media_sideload_image($url, $parent_id, $desc, "id");
  }

  private function assign_image_to_user_meta($new_user_id, $image_id)
  {
    $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
    update_user_meta($new_user_id, "prv_user_identity_pic_id", $image_id);
    update_user_meta($new_user_id, "prv_user_identity_pic", $image_url);
  }


  public function save_image($new_user_id)
  {
    $this->save_temporary();
    $image_id = $this->create_attachment();
    $this->delete_temp_file();

    if (is_wp_error($image_id)) {
      return $image_id->get_error_messages();
    } else {
      $this->assign_image_to_user_meta($new_user_id, $image_id);
    }
  }
}
