<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://bizevolv.com
 * @since      1.0.0
 *
 * @package    Woo_Timepayment_Gateway
 * @subpackage Woo_Timepayment_Gateway/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Timepayment_Gateway
 * @subpackage Woo_Timepayment_Gateway/includes
 * @author     Jason@BizEvolv.com <jason@bizevolv.com>
 */
class Woo_Timepayment_Gateway_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'timepayment-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
