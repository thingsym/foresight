<?php
/**
 * Class Test_Customizer_Panel
 *
 * @package Foresight
 */

class Test_Customizer_Panel extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->panel = new \Foresight\Functions\Customizer\Panel();

		require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';

		$user_id = self::factory()->user->create( [
			'role' => 'administrator',
		] );

		if ( is_multisite() ) {
			grant_super_admin( $user_id );
		}

		wp_set_current_user( $user_id );

		global $wp_customize;
		$this->wp_customize = new WP_Customize_Manager();
		$wp_customize       = $this->wp_customize;

		do_action( 'customize_register', $this->wp_customize );
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Customizer_Panel
	 */
	public function public_variable() {
		$this->assertSame( 'edit_theme_options', $this->panel->capability );
	}

	/**
	 * @test
	 * @group Customizer_Panel
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->panel, 'register_panel' ] ) );
	}

	/**
	 * @test
	 * @group Customizer_Panel
	 */
	public function register_panel() {
		$panel = $this->wp_customize->get_panel( 'font' );
		$this->assertSame( 'font', $panel->id );
		$this->assertSame( 51, $panel->priority );
		$this->assertSame( 'edit_theme_options', $panel->capability );
		$this->assertSame( 'Font', $panel->title );

		$panel = $this->wp_customize->get_panel( 'layout' );
		$this->assertSame( 'layout', $panel->id );
		$this->assertSame( 81, $panel->priority );
		$this->assertSame( 'edit_theme_options', $panel->capability );
		$this->assertSame( 'Layout', $panel->title );
	}

}
