<?php
/**
 * Class Test_Customizer_Sanitize
 *
 * @package Foresight
 */

use Foresight\Functions\Customizer\Sanitize;

class Test_Customizer_Sanitize extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function sanitize_checkbox_boolean() {
		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[
				'default' => 0,
			]
		);

		$this->assertTrue( Sanitize::sanitize_checkbox_boolean( true, $setting ) );
		$this->assertFalse( Sanitize::sanitize_checkbox_boolean( false, $setting ) );
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function sanitize_number_absint() {
		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[]
		);

		$this->assertSame( 1, Sanitize::sanitize_number_absint( 1, $setting ) );
		$this->assertSame( 1, Sanitize::sanitize_number_absint( -1, $setting ) );
		$this->assertSame( '', Sanitize::sanitize_number_absint( 0, $setting ) );
		$this->assertSame( '', Sanitize::sanitize_number_absint( '', $setting ) );
		$this->assertSame( '', Sanitize::sanitize_number_absint( 'aaa', $setting ) );

		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[
				'default' => 0,
			]
		);

		$this->assertSame( 1, Sanitize::sanitize_number_absint( 1, $setting ) );
		$this->assertSame( 1, Sanitize::sanitize_number_absint( -1, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number_absint( 0, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number_absint( '', $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number_absint( 'aaa', $setting ) );

		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[
				'default' => 'a',
			]
		);

		$this->assertSame( 1, Sanitize::sanitize_number_absint( 1, $setting ) );
		$this->assertSame( 1, Sanitize::sanitize_number_absint( -1, $setting ) );
		$this->assertSame( 'a', Sanitize::sanitize_number_absint( 0, $setting ) );
		$this->assertSame( 'a', Sanitize::sanitize_number_absint( '', $setting ) );
		$this->assertSame( 'a', Sanitize::sanitize_number_absint( 'aaa', $setting ) );
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function sanitize_number() {
		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[]
		);

		$this->assertSame( 1, Sanitize::sanitize_number( 1, $setting ) );
		$this->assertSame( -1, Sanitize::sanitize_number( -1, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number( 0, $setting ) );
		$this->assertSame( '', Sanitize::sanitize_number( '', $setting ) );
		$this->assertSame( '', Sanitize::sanitize_number( 'aaa', $setting ) );

		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[
				'default' => 0,
			]
		);

		$this->assertSame( 1, Sanitize::sanitize_number( 1, $setting ) );
		$this->assertSame( -1, Sanitize::sanitize_number( -1, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number( 0, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number( '', $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number( 'aaa', $setting ) );

		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[
				'default' => 'a',
			]
		);

		$this->assertSame( 1, Sanitize::sanitize_number( 1, $setting ) );
		$this->assertSame( -1, Sanitize::sanitize_number( -1, $setting ) );
		$this->assertSame( 0, Sanitize::sanitize_number( 0, $setting ) );
		$this->assertSame( 'a', Sanitize::sanitize_number( '', $setting ) );
		$this->assertSame( 'a', Sanitize::sanitize_number( 'aaa', $setting ) );
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function sanitize_select() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function sanitize_radio() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
