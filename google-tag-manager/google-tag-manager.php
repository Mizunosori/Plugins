<?php

/**
 * @package Login screen
 */
/*
Plugin Name: Google tag manager
Description: Insert google tag manager scripts in site
Version: 1.0
Author: FilipC
*/

define('GOOGLE_TAG_MANAGER_PLUGIN', __FILE__);
define('GOOGLE_TAG_MANAGER_PLUGIN_DIR', untrailingslashit(dirname(GOOGLE_TAG_MANAGER_PLUGIN)));
define('GOOGLE_TAG_MANAGER_PLUGIN_URI', untrailingslashit(plugin_dir_url(GOOGLE_TAG_MANAGER_PLUGIN)));

/**
 * INCLUDES
 */
require_once GOOGLE_TAG_MANAGER_PLUGIN_DIR . '/includes/functions.php';

/**
 * ADMIN CODE
 */
if (is_admin()) {
    require_once GOOGLE_TAG_MANAGER_PLUGIN_DIR . '/admin/admin.php';
}