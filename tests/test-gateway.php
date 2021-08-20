<?php
/**
 * Class WC_Gateway_Pigeon_Test
 *
 * @package WoocommercePigeonGatewayTest
 */

class WC_Gateway_Pigeon_Test extends WP_UnitTestCase
{
    /**
     * Initialize our class.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->activate_woocommerce();
        $this->class_instance = new Woocommerce_Pigeon_Gateway();
        $this->gateway = $this->class_instance->add_payment_gateway();
    }

    /**
     * Activate WooCommerce.
     *
     * @return void
     */
    public function activate_woocommerce()
    {
        require_once( ABSPATH . 'wp-content/plugins/woocommerce/woocommerce.php' );

        if ( ! function_exists('activate_plugin') ) {
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        if( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            activate_plugin( 'woocommerce/woocommerce.php' );
        }
    }

    /**
     * Check that the gateway is initialized.
     *
     * @return void
     */
    public function test_init()
    {
        $instance = $this->gateway;
        $expected = 'WC_Gateway_Pigeon';

        $this->assertInstanceOf($expected, $instance);
    }

    /**
     * Check if fields are initialized.
     *
     * @return void
     */
    public function test_init_form_fields()
    {
        $this->gateway->init_form_fields();
        $fields = $this->gateway->form_fields;
        $expected = 3;

        $this->assertCount($expected, $fields);
    }
}