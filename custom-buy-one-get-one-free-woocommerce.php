<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              localhost/wordpress
 * @since             1.0
 * @package           Buy_One_Get_One_Free_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Buy Two get one free
 * Description:       Product Buy Two and Get one free in WooCommerce
 * Version:           1.0
 * Author:            jegadesh
 * Text Domain:       custom-buy-one-get-one-free-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	
	die;
	
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


if(!is_plugin_active( 'woocommerce/woocommerce.php')){
    function custom_bogo_deal() {
        ?>
        <div class="error notice">
            <p><?php _e( 'Please Install and Activate WooCommerce plugin, without that this offer plugin cant work', 'custom-buy-one-get-one-free-woocommerce' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'custom_bogo_deal' );
    return;
}


define( 'CUSTOM_BUY_ONE_GET_ONE_FREE_WOOCOMMERCE_VERSION', '1.0' );

define( 'CUSTOM_BOGO_DELETE_SETTING', false );



function activate_custom_buy_one_get_one_free_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-buy-one-get-one-free-woocommerce-activator.php';
	Custom_Buy_One_Get_One_Free_Woocommerce_Activator::activate();
}


function deactivate_custom_buy_one_get_one_free_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-buy-one-get-one-free-woocommerce-deactivator.php';
	Custom_Buy_One_Get_One_Free_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_buy_one_get_one_free_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_custom_buy_one_get_one_free_woocommerce' );


require plugin_dir_path( __FILE__ ) . 'includes/class-custom-buy-one-get-one-free-woocommerce.php';

function custom_plugin_link( $links ) {
	$links = array_merge( array(
        '<a href="' . esc_url( admin_url( '/admin.php?page=custom-bogo-deal' ) ) . '">' . __( 'Settings' ) . '</a>',
	), $links );
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'custom_plugin_link' );


if(!function_exists('custom_wc_version_check')){
function custom_wc_version_check( $version = '3.0' ) {
	if ( class_exists( 'WooCommerce' ) ) {
		global $woocommerce;
		if ( version_compare( $woocommerce->version, $version, ">=" ) ) {
			return true;
		}
	}
	return false;
}
}


function run_buy_one_get_one_free_woocommerce() {

	$plugin = new Buy_One_Get_One_Free_Woocommerce();
	$plugin->run();

}
run_buy_one_get_one_free_woocommerce();