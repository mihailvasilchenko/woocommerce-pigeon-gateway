<?php

/**
 * Woocommerce Pigeon Gateway Class
 *
 * Defines hooks and initializes the setup.
 *
 * @package WooCommercePigeonGateway
 */

namespace WooCommercePigeonGateway;

/**
 * Class WoocommercePigeonGateway
 */
class WooCommercePigeonGateway
{
    /**
     * Initialize plugin.
     */
    public function run()
    {
        add_action('plugins_loaded', array( $this, 'addPaymentGateway' ));
    }

    /**
     * Check if WooCommerce is active and add payment gateway.
     *
     * @return mixed
     */
    public function addPaymentGateway()
    {
        if (
            ! in_array(
                'woocommerce/woocommerce.php',
                apply_filters('active_plugins', get_option('active_plugins')),
                true
            )
        ) {
            // Show warning.
            add_action('admin_notices', array( $this, 'showWoocommerceGatewayWarning' ));

            return;
        }

        /**
         * Initialize payent gateway.
         */
        $payment_gateway = new WCGatewayPigeon();

        return $payment_gateway;
    }

    /**
     * Show activation warning.
     */
    public function showWoocommerceGatewayWarning()
    {
        ob_start();
        ?>
            <div class="error">
                <p>
                    <?php
                    esc_html_e(
                        'Please activate WooCommerce to use WooCommerce Pigeon Gateway.',
                        'woocommerce-pigeon-gateway'
                    );
                    ?>
                </p>
            </div>
        <?php
        echo wp_kses_post(ob_get_clean());
    }
}
