<?php

add_action('wp_head', 'add_gtm_script');
add_action('wp_body_open', 'add_gtm_noscript');

function add_gtm_script() {
    $options = get_option( 'tracking_settings' );
    $gtmScript = isset($options['gtm_id']) ? $options['gtm_id'] : '';

    if ($gtmScript) {
        echo '<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'' . $gtmScript .'\');</script>
<!-- End Google Tag Manager -->';
            
    }
}

function add_gtm_noscript() {
    $options = get_option( 'tracking_settings' );
    $gtmNoScript = isset($options['gtm_id']) ? $options['gtm_id'] : '';

    if ($gtmNoScript) {
        echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='. $gtmNoScript .'"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
    }
}

add_action('wp_head', 'add_facebook_pixel_script');

function add_facebook_pixel_script () {
    $options = get_option( 'tracking_settings' );
    $fbPixel = isset($options['facebook_pixel_id']) ? $options['facebook_pixel_id'] : '';

    if ($fbPixel) {
        echo '<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,\'script\',
  \'https://connect.facebook.net/en_US/fbevents.js\');
  fbq(\'init\', \''. $fbPixel .'\');
  fbq(\'track\', \'PageView\');
</script>
<noscript>
  <img height="1" width="1" style="display:none" 
       src="https://www.facebook.com/tr?id='. $fbPixel .'&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->';
    }

}