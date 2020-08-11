<?php

add_action( 'admin_menu', 'gtm_add_admin_menu' );
add_action( 'admin_init', 'gtm_settings_init' );

function gtm_add_admin_menu()
{
    if ( empty ( $GLOBALS['admin_page_hooks']['option_page'] ) ) {
        add_menu_page('Custom Option', 'Custom Option', '', 'option_page');
        add_submenu_page('option_page', 'GTM', 'GTM', 'manage_options', 'gtm_options', 'gtm_option_page');
    }
    else {
        add_submenu_page('option_page', 'GTM', 'GTM', 'manage_options', 'gtm_options', 'gtm_option_page');
    }
}

function gtm_settings_init()
{
    register_setting( 'track_settings_theme', 'tracking_settings', 'save_track_settings_theme_settings' );

    add_settings_section(
        'gtm_section',
        __( 'Google Tag Manager ID', 'muzli' ),
        false,
        'track_settings_theme'
    );

    add_settings_field(
        'gtm_id',
        __( 'Insert GTM-ID', 'muzli' ),
        'gtm_render',
        'track_settings_theme',
        'gtm_section'
    );

    add_settings_section(
        'facebook_pixel_section',
        __( 'Facebook Pixel', 'muzli' ),
        false,
        'track_settings_theme'
    );

    add_settings_field(
        'facebook_pixel_id',
        __( 'Insert Facebook Pixel ID', 'muzli' ),
        'facebook_pixel_id_render',
        'track_settings_theme',
        'facebook_pixel_section'
    );

}

// sanitize data and upload logo
function save_track_settings_theme_settings( $data )
{
    $data = array_map('sanitize_text_field', $data);
    $options = extend_array( get_option( 'tracking_settings' ), $data );

    return $options;
}

// copyright by field
function gtm_render()
{
    $options = get_option( 'tracking_settings' );
    $value = isset($options['gtm_id']) ? $options['gtm_id'] : '';
    ?>
    <input type="text" name="tracking_settings[gtm_id]" value="<?php echo $value ?>" class="regular-text">
    <?php
}

// copyright text field
function facebook_pixel_id_render()
{
    $options = get_option( 'tracking_settings' );
    $value = isset($options['facebook_pixel_id']) ? $options['facebook_pixel_id'] : '';
    ?>
    <input type="text" name="tracking_settings[facebook_pixel_id]" value="<?php echo $value ?>" class="regular-text">
    <?php
}

// theme options form
function gtm_option_page()
{
    ?>
    <div class="wrap">
        <h1>Tracking Settings</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'track_settings_theme' );
            do_settings_sections( 'track_settings_theme' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}