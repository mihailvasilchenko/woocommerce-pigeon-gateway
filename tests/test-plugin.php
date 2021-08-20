<?php
/**
 * Class Woocommerce_Pigeon_Gateway_Test
 *
 * @package WoocommercePigeonGatewayTest
 */

class Woocommerce_Pigeon_Gateway_Test extends WP_UnitTestCase
{
    /**
     * Initialize our class.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->class_instance = new Woocommerce_Pigeon_Gateway();
    }

    /**
     * Check that gateway is not added if WooCommerce is not installed.
     *
     * @return void
     */
    public function test_payment_gateway_not_added_if_woocoommerce_not_installed()
    {
        $payment_gateway = $this->class_instance->add_payment_gateway();
        $expected = false;

        $this->assertEquals($expected, $payment_gateway);
    }

    /**
     * Check if warning is shown.
     *
     * @return void
     */
    public function test_show_woocommerce_gateway_warning()
    {   
        ob_start();
        $this->class_instance->show_woocommerce_gateway_warning();
        $warning = ob_get_clean();
        $expected = 'error';

        $this->assertContains($expected, $warning);
    }
}