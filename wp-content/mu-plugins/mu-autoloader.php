<?php

/**
 * Plugin Name: Must Use Plugins Autoloader
 * Description: Only manually load must use plugins, in must use directory
 * Author: WordPress Codex
 */

/**
 * CMB2 Get the bootstrap!
 */
require_once WPMU_PLUGIN_DIR . '/cmb2/init.php';

require_once WPMU_PLUGIN_DIR . '/login/custom-login.php';

require_once WPMU_PLUGIN_DIR . '/distributor/custom-distributor.php';

require_once WPMU_PLUGIN_DIR . '/dealer-list/dealer-list.php';

require_once WPMU_PLUGIN_DIR . '/social-share/share.php';
