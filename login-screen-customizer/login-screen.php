<?php

/**
 * @package Login screen
 */
/*
Plugin Name: Login screen customizer
Description: Use it for customize login screen (Logo, background).
Version: 1.0
Author: FilipC
*/

define('LOGIN_SCREEN_PLUGIN', __FILE__);
define('LOGIN_SCREEN_PLUGIN_DIR', untrailingslashit(dirname(LOGIN_SCREEN_PLUGIN)));
define('LOGIN_SCREEN_PLUGIN_URI', untrailingslashit(plugin_dir_url(LOGIN_SCREEN_PLUGIN)));

/**
 * INCLUDES
 */
require_once LOGIN_SCREEN_PLUGIN_DIR . '/includes/functions.php';

/**
 * ADMIN CODE
 */
if (is_admin()) {
    require_once LOGIN_SCREEN_PLUGIN_DIR . '/admin/admin.php';
}

add_action('admin_head', 'admin_styles');

function admin_styles()
{
    wp_enqueue_style( 'muster-options-style', LOGIN_SCREEN_PLUGIN_URI . '/includes/options-page.css' );
}

add_action( 'admin_menu', 'muster_add_admin_menu' );
add_action( 'admin_init', 'muster_settings_init' );

function muster_add_admin_menu()
{
    if ( empty ( $GLOBALS['admin_page_hooks']['option_page'] ) ) {
        add_menu_page('Custom Option', 'Custom Option', '', 'option_page');
        add_submenu_page('option_page', 'Login Page', 'Login Page', 'manage_options', 'login_options', 'muster_options_page');
    }
    else {
        add_submenu_page('option_page', 'Login Page', 'Login Page', 'manage_options', 'login_options', 'muster_options_page');
    }
}