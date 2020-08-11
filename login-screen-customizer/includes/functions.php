<?php

/************************************************************************************/
/* Custom admin login */
/************************************************************************************/
function my_login_logo() {

    $options = get_option( 'muster_settings' );
    $logo = isset($options['logo']) ? $options['logo'] : '';
    $background = isset($options['background']) ? $options['background'] : ''; ?>

    <style type="text/css">
        #login h1, .login h1 {
            background: rgba(255,255,255,.7);
            border-radius: 5px;
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url( $logo ) ?>);
            height: 50px;
            width: 200px;
            background-size: 200px 50px;
            background-repeat: no-repeat;
            background-position: center;
            padding: 30px;
        }
        .login {
            background-image: url(<?php echo esc_url( $background ) ?>);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
        #nav,#backtoblog{display:none}
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function login_logo_url() {
    return get_home_url();
}

add_filter( 'login_headerurl', 'login_logo_url' );