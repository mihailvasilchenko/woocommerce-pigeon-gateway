<?php

/**
 * Class WCGatewayPigeonTest
 *
 * @package WoocommercePigeonGatewayTest
 */

namespace WooCommercePigeonGatewayTest;

use WP_UnitTestCase;

class WCGatewayPigeonTest extends WP_UnitTestCase
{
    /**
     * Initialize our class.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->activateWooCommerce();
        $this->classInstance = new \WooCommercePigeonGateway\WooCommercePigeonGateway();
        $this->gateway = $this->classInstance->addPaymentGateway();
    }

    /**
     * Activate WooCommerce.
     *
     * @return void
     */
    public function activateWooCommerce()
    {
        require_once(ABSPATH . 'wp-content/plugins/woocommerce/woocommerce.php');

        if (! function_exists('activate_plugin')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }

        if (! is_plugin_active('woocommerce/woocommerce.php')) {
            activate_plugin('woocommerce/woocommerce.php');
        }
    }

    /**
     * Check that the gateway is initialized.
     *
     * @return void
     */
    public function testInit()
    {
        $instance = $this->gateway;
        $expected = 'WooCommercePigeonGateway\WCGatewayPigeon';

        $this->assertInstanceOf($expected, $instance);
    }

    /**
     * Check if fields are initialized.
     *
     * @return void
     */
    public function testInitFormFields()
    {
        $this->gateway->initFormFields();
        
        $fields = $this->gateway->form_fields;
        $expected = 3;

        $this->assertCount($expected, $fields);
    }
}
