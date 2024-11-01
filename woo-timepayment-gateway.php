<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://bizevolv.com/wordpress/woo-timepayment-gateway/
 * @since             1.0.0
 * @package           Woo_Timepayment_Gateway
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Timepayment Gateway
 * Plugin URI:        http://bizevolv.com/wordpress/woo-timepayment-gateway/
 * Description:       Woo Timepayment Gateway allows you to offer TimePayment financing to your customers during WooCommerce checkout, in the form of a payment gateway. You must have a free TimePayment vendor account for this plugin to work. Your customer will be taken to TimePayment secure online financing application to finish their checkout. Your TimePayment vendor account code and the customer cart/order details will be posted to the TimePayment secure online application via POST method. The customer simply finishes the quick application and in most cases is notified instantly of approval.
 * Version:           1.0.0
 * Author:            Jason Coleman
 * Author URI:        http://bizevolv.com/wordpress/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-timepayment-gateway
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_TIMEPAYMENT_GATEWAY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-timepayment-gateway-activator.php
 */
function activate_timepayment_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-timepayment-gateway-activator.php';
	Woo_Timepayment_Gateway_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-timepayment-gateway-deactivator.php
 */
function deactivate_woo_timepayment_gateway() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-timepayment-gateway-deactivator.php';
	Woo_Timepayment_Gateway_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_timepayment_gateway' );
register_deactivation_hook( __FILE__, 'deactivate_woo_timepayment_gateway' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-timepayment-gateway.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_timepayment_gateway() {

	$plugin = new Woo_Timepayment_Gateway();
	$plugin->run();

}
run_woo_timepayment_gateway();
