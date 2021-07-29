<?php

/**
 * Fired during plugin activation
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Custom_Buy_One_Get_One_Free_Woocommerce
 * @subpackage Custom_Buy_One_Get_One_Free_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Custom_Buy_One_Get_One_Free_Woocommerce
 * @subpackage Custom_Buy_One_Get_One_Free_Woocommerce/includes
 * @author     Developer
 */
class Custom_Buy_One_Get_One_Free_Woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('pisol_bogo_redirect', true);
	}

}
