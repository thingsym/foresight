<?php
/**
 * Class Test_Customize_Control_Layout_Picker
 *
 * @package Foresight
 */

class Test_Customize_Control_Layout_Picker extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();

		require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

		$this->layout_picker = new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker();
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function constructor() {
		$this->assertInstanceOf( '\WP_Customize_Control', $this->layout_picker );

		$this->assertSame( 10, has_filter( 'customize_controls_print_styles', [ $this->layout_picker, 'customize_control_enqueue_styles' ] ) );
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function render_content() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function sanitize_layout() {
		$manager = New WP_Customize_Manager();

		$manager->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker(
				$manager,
				'test',
				[
					'type'    => 'layout',
					'options' => [
						'aaa'   => [
							'label' => 'aaa',
							'svg'   => '',
						],
						'bbb'   => [
							'label' => 'bbb',
							'svg'   => '',
						],
						'ccc'   => [
							'label' => 'ccc',
							'svg'   => '',
						],
					],
				]
			)
		);

		$setting = New WP_Customize_Setting(
			$manager,
			'test',
			[
				'default' => 'ddd',
			]
		);

		$this->assertSame( 'aaa', $this->layout_picker->sanitize_layout( 'aaa', $setting ) );
		$this->assertSame( 'bbb', $this->layout_picker->sanitize_layout( 'bbb', $setting ) );
		$this->assertSame( 'ccc', $this->layout_picker->sanitize_layout( 'ccc', $setting ) );
		$this->assertSame( 'ddd', $this->layout_picker->sanitize_layout( 'eee', $setting ) );
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function enqueue() {
		$result = $this->layout_picker->enqueue();
		$this->assertTrue( $result );
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function customize_control_enqueue_styles() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
