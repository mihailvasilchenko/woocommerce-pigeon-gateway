<?php

/**
 * Class WCGatewayPigeon.
 *
 * @package WooCommercePigeonGateway\includes
 */

namespace WooCommercePigeonGateway;

use WC_Payment_Gateway;

/**
 * Pigeon Payment Gateway.
 *
 * Provides a Pigeon Payment Gateway.
 *
 * @class       WCGatewayPigeon
 * @extends     WC_Payment_Gateway
 * @version     1.0.0
 * @package     WooCommerce\Classes\Payment
 */
class WCGatewayPigeon extends WC_Payment_Gateway
{
    /**
     * Constructor for the gateway.
     */
    public function __construct()
    {
        $this->id                 = 'pigeon';
        $this->icon               = apply_filters('woocommerce_pigeon_icon', '');
        $this->has_fields         = false;
        $this->method_title       = __('Direct pigeon transfer', 'woocommerce-pigeon-gateway');
        $this->method_description = __('Receive payments via our trained pigeons.', 'woocommerce-pigeon-gateway');

        // Load the settings.
        $this->initFormFields();

        // Define user set variables.
        $this->title       = $this->get_option('title');
        $this->description = $this->get_option('description');

        // Actions.
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ));

        // Filters.
        add_filter('woocommerce_payment_gateways', array( $this, 'registerPaymentMethod' ));
    }

    /**
     * Initialise Gateway Settings Form Fields.
     */
    public function initFormFields()
    {
        $this->form_fields = array(
            'enabled'     => array(
                'title'   => __('Enable/Disable', 'woocommerce-pigeon-gateway'),
                'type'    => 'checkbox',
                'label'   => __('Enable pigeon transfer', 'woocommerce-pigeon-gateway'),
                'default' => 'no',
            ),
            'title'       => array(
                'title'       => __('Title', 'woocommerce'),
                'type'        => 'text',
                'description' => __(
                    'This controls the title which the user sees during checkout.',
                    'woocommerce-pigeon-gateway'
                ),
                'default'     => __('Pigeon', 'woocommerce-pigeon-gateway'),
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => __('Description', 'woocommerce-pigeon-gateway'),
                'type'        => 'textarea',
                'description' => __(
                    'Payment method description that the customer will see on your checkout.',
                    'woocommwoocommerce-pigeon-gatewayerce'
                ),
                'default'     => __(
                    'Your order will be fulfilled as soon as we receive the money from one of our trained pigeons.',
                    'woocommerce-pigeon-gateway'
                ),
                'desc_tip'    => true,
            ),
        );
    }

    /**
     * Process the payment and return the result.
     *
     * @param int $order_id Order ID.
     * @return array
     */
	// phpcs:ignore
    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);

        if ($order->get_total() > 0) {
            // Mark as on-hold (we're awaiting the payment).
            $order->update_status(
                apply_filters('woocommerce_pigeon_process_payment_order_status', 'on-hold', $order),
                __('Awaiting pigeon payment', 'woocommerce-pigeon-gateway')
            );
        } else {
            $order->payment_complete();
        }

        // Empty cart.
        WC()->cart->empty_cart();

        // Return thank you redirect.
        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url($order),
        );
    }

    /**
     * Register payment method.
     *
     * @param array $methods Payment methods.
     *
     * @return array
     */
    public function registerPaymentMethod($methods)
    {
        $methods[] = 'WooCommercePigeonGateway\WCGatewayPigeon';

        return $methods;
    }
}
