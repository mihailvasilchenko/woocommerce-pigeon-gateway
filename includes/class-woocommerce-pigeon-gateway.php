<?php
/**
 * Woocommerce Pigeon Gateway Class
 *
 * Defines hooks and initializes the setup.
 *
 * @package WooCommercePigeonGateway\includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Woocommerce_Pigeon_Gateway
 */
class Woocommerce_Pigeon_Gateway {
	/**
	 * Initialize plugin.
	 */
	public function run() {
		add_action( 'plugins_loaded', array( $this, 'add_payment_gateway' ) );
	}

	/**
	 * Check if WooCommerce is active and add payment gateway.
	 *
	 * @return void
	 */
	public function add_payment_gateway() {
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
			add_action( 'admin_notices', array( $this, 'show_woocommerce_gateway_warning' ) );

			return;
		}

		/**
		 * Add our gateway class here.
		 */
	}

	/**
	 * Show activation warning.
	 */
	public function show_woocommerce_gateway_warning() {
		ob_start();
		?>
			<div class="error">
				<p>
					<?php esc_html_e( 'Please activate WooCommerce to use WooCommerce Pigeon Gateway.', 'woocommerce-pigeon-gateway' ); ?>
				</p>
			</div>
		<?php
		echo wp_kses_post( ob_get_clean() );
	}
}