<?php

/**
 * Class WoocommercePigeonGatewayTest
 *
 * @package WoocommercePigeonGatewayTest
 */

namespace WooCommercePigeonGatewayTest;

use WP_UnitTestCase;

class WoocommercePigeonGatewayTest extends WP_UnitTestCase
{
    /**
     * Initialize our class.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->classInstance = new \WooCommercePigeonGateway\WooCommercePigeonGateway();
    }

    /**
     * Check that gateway is not added if WooCommerce is not installed.
     *
     * @return void
     */
    public function testAddPaymentGateway()
    {
        $paymentGateway = $this->classInstance->addPaymentGateway();
        $expected = false;

        $this->assertEquals($expected, $paymentGateway);
    }

    /**
     * Check if warning is shown.
     *
     * @return void
     */
    public function testShowWoocommerceGatewayWarning()
    {
        ob_start();

        $this->classInstance->showWoocommerceGatewayWarning();
        
        $warning = ob_get_clean();
        $expected = 'error';

        $this->assertContains($expected, $warning);
    }
}
