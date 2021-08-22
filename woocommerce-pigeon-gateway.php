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

namespace WooCommercePigeonGateway;

/**
 * Add Composer's PSR-4 autoload.
 */
require_once dirname(__FILE__) . "/vendor/autoload.php";

/**
 * Begins execution of the plugin.
 */
$plugin = new WooCommercePigeonGateway();

$plugin->run();
