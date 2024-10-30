<?php 
/**
 * Plugin Name:         Click to Top Button
 * Plugin URI:          https://wordpress.org/plugins/click+to+top+button/
 * Description:         Click to Top Button is a WordPress plugin that adds a convenient and customizable button to quickly scroll back to the top of a page.
 * Version:             1.0.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Tamzid Mahdi Sakib
 * Author URI:          https://tamzidsakib.com/
 * License:             GPLv2 or later
 * License URI:         https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * Text Domain:         cttb
 */

//including css
function cttb_enqueue_style(){
    wp_enqueue_style('cttb-style', plugins_url('css/cttb-style.css', __FILE__));
}
add_action("wp_enqueue_scripts","cttb_enqueue_style");

//including javascript
function cttb_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('cttb-plugin-script', plugins_url('js/cttb-plugin.js', __FILE__), array(), '1.0.0', 'true');
}
add_action("wp_enqueue_scripts","cttb_enqueue_scripts");

//jquery plugin settings activation
function cttb_scroll_script(){?>
    <script>
    jQuery(document).ready(function(){
        jQuery.scrollUp();
    });
    </script>
<?php
}
add_action("wp_footer","cttb_scroll_script");


//plugin customization settings
add_action("customize_register","cttb_scroll_to_top");
function cttb_scroll_to_top($wp_customize){
$wp_customize-> add_section('cttb_scroll_to_top_section',array(
    'title' =>__('Click to Top Button','tamzidsakib'),
    'description' => 'Click to Top Button is a WordPress plugin  to quickly scroll back to the top of a page.',
    ));

$wp_customize-> add_setting('cttb_default_color',array(
    'default' => '#000000',
    ));   
        
$wp_customize-> add_control('cttb_default_color',array(
    'label' =>   'Background Color',
    'section' => 'cttb_scroll_to_top_section',
    'type' =>    'color',
    ));
    
$wp_customize-> add_setting('cttb_rounded_corner',array(
        'default' => '5px',
        ));   
            
$wp_customize-> add_control('cttb_rounded_corner',array(
        'label' =>   'Rounded Corner',
        'section' => 'cttb_scroll_to_top_section',
        'type' =>    'text',
        ));  

}

//plugin CSS customization
function cttb_plugin_bg_cus(){
?>
<style>
#scrollUp {
    background-color: <?php print get_theme_mod("cttb_default_color");?>;
    border-radius: <?php print get_theme_mod("cttb_rounded_corner");?>;
}
</style>
<?php
} 
add_action('wp_head', 'cttb_plugin_bg_cus');
?>