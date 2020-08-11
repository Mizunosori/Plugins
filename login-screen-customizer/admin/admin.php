<?php

function muster_settings_init()
{
    register_setting( 'muster_theme', 'muster_settings', 'save_muster_theme_settings' );

    add_settings_section(
        'muster_logo_section',
        __( 'Upload a Logo', 'muster' ),
        false,
        'muster_theme'
    );

    add_settings_field(
        'logo',
        __( 'Choose an Image', 'muster' ),
        'muster_logo_render',
        'muster_theme',
        'muster_logo_section'
    );
    add_settings_section(
        'muster_background_section',
        __( 'Upload login background', 'muster' ),
        false,
        'muster_theme'
    );

    add_settings_field(
        'background',
        __( 'Choose an Image', 'muster' ),
        'muster_background_render',
        'muster_theme',
        'muster_background_section'
    );
}

// sanitize data and upload logo
function save_muster_theme_settings()
{
    $options = extend_array( get_option('muster_settings'));

    if ( !empty( $_FILES['background']['tmp_name'] ) && file_is_displayable_image( $_FILES['background']['tmp_name'] ) ) {
        $upload = wp_handle_upload( $_FILES['background'], array('test_form' => false) );
        $options['background'] = $upload['url'];
    }

    if ( !empty( $_FILES['logo']['tmp_name'] ) && file_is_displayable_image( $_FILES['logo']['tmp_name'] ) ) {
        $upload = wp_handle_upload( $_FILES['logo'], array('test_form' => false) );
        $options['logo'] = $upload['url'];
    }

    return $options;
}

// upload logo
function muster_logo_render()
{
    $options = get_option( 'muster_settings' );
    $logo = isset($options['logo']) ? $options['logo'] : ''; ?>

    <p><input type="file" name="logo"></p>

    <?php if ( $logo ) : ?>

    <p><img src="<?php echo esc_url( $logo ) ?>" alt="muster-logo" class="muster-logo"></p>

<?php endif;
}

function muster_background_render()
{
    $options = get_option( 'muster_settings' );
    $background = isset($options['background']) ? $options['background'] : ''; ?>

    <p><input type="file" name="background"></p>

    <?php if ( $background ) : ?>

    <p><img src="<?php echo esc_url( $background ) ?>" alt="muster-logo" class="muster-logo"></p>

<?php endif;
}

// theme options form
function muster_options_page()
{
    ?>
    <div class="wrap">
        <h1>Login page options</h1>
        <form action="options.php" method="post" enctype="multipart/form-data">
            <?php
            settings_fields( 'muster_theme' );
            do_settings_sections( 'muster_theme' );
            submit_button();
            ?>
        </form>

    </div>
    <?php
}