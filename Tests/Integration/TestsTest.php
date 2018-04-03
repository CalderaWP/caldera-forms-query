<?php


namespace calderawp\CalderaFormsQuery\Tests\Integration;

/**
 * Class TestsTest
 *
 * Tests to ensure integration test environment is working
 * @package calderawp\CalderaFormsQuery\Tests\Integration
 */
class TestsTest extends IntegrationTestCase
{

	/**
	 * Check that Caldera Forms is usable
	 */
	public function testCalderaFormsIsInstalled()
	{
		$this->assertTrue( defined( 'CFCORE_VER' ) );
		$this->assertTrue( class_exists( '\Caldera_Forms' ) );
	}

}