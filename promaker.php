<?php
/*
Plugin Name:  Promaker Dashboard
Description:  Panel de control con UI de Promaker
Version:      1.0
Author:       Jonathan Peralta | Promaker
Author URI:   https://promaker.com.ar
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/
/*===== Disable Login Language Switcher =====*/
add_filter( 'login_display_language_dropdown', '__return_false' );
/*===== Imágenes login =====*/
function prmk_dashboard_custom_img_login() { ?>
    <style type="text/css">
        .login {background-image: url(<?php echo plugin_dir_url( __FILE__ ); ?>/img/back.jpg) !important;}
        #login h1 a, .login h1 a {
            background-image: url(<?php echo plugin_dir_url( __FILE__ ); ?>/img/promaker.svg) !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'prmk_dashboard_custom_img_login' );
/*===== Assets UI =====*/
function prmk_dashboard_ui_assets() {
    wp_enqueue_style( 'promaker-dashboard', plugin_dir_url( __FILE__ ) . 'css/promaker-dashboard.min.css', 1.0, false );
}
add_action( 'login_enqueue_scripts', 'prmk_dashboard_ui_assets' );
/*===== Login logo URL =====*/
function prmk_dashboard_custom_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'prmk_dashboard_custom_login_url' );
/*===== Remove WP Logo admin =====*/
function prmk_dashboard_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'prmk_dashboard_admin_bar_remove_logo', 0 );
/*===== Custom Logo admin =====*/
add_action( 'admin_bar_menu', 'prmk_dashboard_admin_bar_item', 10 );
function prmk_dashboard_admin_bar_item ( WP_Admin_Bar $admin_bar ) {
	$admin_bar->add_menu( array(
		'id'    => 'promaker-logo-admin',
		'parent' => null,
		'group'  => null,
		'title' => '<img src="'. plugin_dir_url( __FILE__ ) .'/img/promaker.svg" alt="promaker" width="90" />',
	) );
}
/*===== Assets Admin =====*/
function prmk_dashboard_admin_assets() {
    wp_enqueue_style( 'promaker-dashboard', plugin_dir_url( __FILE__ ) . 'css/promaker-dashboard.min.css', 1.0, false );
}
add_action( 'admin_enqueue_scripts', 'prmk_dashboard_admin_assets' );
/*===== Remove user schemes colors =====*/
function prmk_dashboard_admin_color_scheme() {
    global $_wp_admin_css_colors;
    $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'prmk_dashboard_admin_color_scheme');