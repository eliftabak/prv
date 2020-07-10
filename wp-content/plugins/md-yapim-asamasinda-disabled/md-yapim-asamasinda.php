<?php
/*
 * Plugin Name: Yapım Aşamasında
 * Plugin URI: http://dulgermuhammet.com
 * Description: Yapım aşamasında sayfası görüntüler.
 * Version: 1.0
 * Author: Muhammet Dülger
 * Author URI: http://dulgermuhammet.com
 * License: GPL2
 *
 * @package md-yapim-asmasinda
 * @copyright Copyright (c) 2020, Muhammet Dülger
 * @license GPL2+
*/

function maintenance_mode()
{

	global $pagenow;
	$is_allowed_ip = ( ('78.189.114.197' === $_SERVER['REMOTE_ADDR']) || ('127.0.0.1' === $_SERVER['REMOTE_ADDR']) ) ? true : false;

	if ($pagenow !== 'wp-login.php' && !current_user_can('manage_options') && !is_admin() && !$is_allowed_ip) {
		header('HTTP/1.1 Service Unavailable', true, 503);
		header('Content-Type: text/html; charset=utf-8');
		if (file_exists(plugin_dir_path(__FILE__) . 'views/maintenance.php')) {
			require_once(plugin_dir_path(__FILE__) . 'views/maintenance.php');
		}
		die();
	}
}

add_action('wp_loaded', 'maintenance_mode');
