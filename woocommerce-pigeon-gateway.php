<?php
/**
 * Plugin Name: WooCommerce Pigeon Gateway
 * Description: An extension which adds a simple WooCommerce payment gateway.
 * Version: 1.0.0
 * Author: Mihail Vasilchenko
 * Author URI: https://geekguts.com/
 *
 * WC requires at least: 5.5.2
 * WC tested up to: 5.6.0
 *
 * License: MIT License
 * License URI: https://github.com/mihailvasilchenko/woocommerce-pigeon-gateway/blob/main/LICENSE
 *
 * Text Domain: woocommerce-pigeon-gateway
 *
 * @since 1.0.0
 * @package WooCommercePigeonGateway
 */

/**
 * Check if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The core plugin class that is used to define hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-pigeon-gateway.php';

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
function run_woocommerce_pigeon_gateway() {
	$plugin = new Woocommerce_Pigeon_Gateway();
	$plugin->run();
}

run_woocommerce_pigeon_gateway();
