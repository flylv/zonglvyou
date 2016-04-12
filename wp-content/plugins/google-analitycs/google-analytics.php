<?php
/*
Plugin Name: Custom Google Analytics
Plugin URI: http://www.meanings.fr
Description: Google Analytics with anchors track support
Version: 0.1
Author: Tony LUCAS
Author URI: http://www.meanings.fr
*/

function google_analytics_snippet() { ?>
<script>    
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '<?php echo get_option('ga_ua_code'); ?>', {'allowAnchor': true});
    ga('send', 'pageview', { 'page': location.pathname + location.search + location.hash});
</script>
<?php }


if (get_option('ga_ua_code') != "") {
  add_action('wp_footer', 'google_analytics_snippet', 20);
}


function add_admin_menu() {
    add_menu_page('Google Analytics with anchors support', 'Google Analytics', 'manage_options', 'ga-anchors', 'menu_html');
}

add_action('admin_menu', 'add_admin_menu');

function menu_html() {
    echo '<h1>' . get_admin_page_title() . '</h1>'; ?>
    <form method="post" action="options.php">
        <?php settings_fields('ga_settings') ?>
        
        <?php add_settings_section('ga_section', 'Paramètres', 'ua_code_html', 'ga_settings'); ?>
        <?php add_settings_field('ga_ua_code', 'Code UA', 'ua_code_html', 'ga_settings', 'zero_newsletter_section'); ?>
        <?php do_settings_sections('ga_settings') ?>
        <?php submit_button(); ?>
    </form>
    <?php
}

function ua_code_html() {?>
    <label>Votre code UA : </label>
    <input type="text" name="ga_ua_code" value="<?php echo get_option('ga_ua_code')?>"/>
    <?php
}

function register_settings() {
    register_setting('ga_settings', 'ga_ua_code');
}
add_action('admin_init', 'register_settings');
