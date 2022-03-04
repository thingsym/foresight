<?php
/**
 * Class Test_Copyright
 *
 * @package Foresight
 */

class Test_Copyright extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->copyright = new \Foresight\Functions\Copyright\Copyright();
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_copyright', $this->copyright->section_id );
		$this->assertSame( 'foresight_copyright_options', $this->copyright->options_name );
		$this->assertSame( 40, $this->copyright->section_priority );
		$this->assertSame( 'edit_theme_options', $this->copyright->capability );

		$expected = [
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => true,
		];
		$this->assertSame( $expected, $this->copyright->default_options );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->copyright, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function get_options() {
		$this->assertNull( $this->copyright->get_options( null, null ) );

		$expected = [
			'copyright'  => 'Copyright &copy; <strong>Test Blog</strong>, All rights reserved.',
			'theme_info' => true,
		];
		$this->assertSame( $expected, $this->copyright->get_options() );

		$options = [
			'copyright'  => 'aaa',
			'theme_info' => false,
		];

		set_theme_mod( $this->copyright->options_name, $options );

		$options = $this->copyright->get_options();
		$this->assertSame( 'aaa', $options['copyright'] );

		$option = $this->copyright->get_options( 'theme_info' );
		$this->assertFalse( $option );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function get_html() {
		# dafault
		$result = $this->copyright->get_html();
		$this->assertRegExp( '#<small>Copyright &copy; <strong>Test Blog</strong>, All rights reserved.</small>#', $result );

		# edited
		$options = [
			'copyright'  => 'aaa',
			'theme_info' => true,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertRegExp( '#<small>aaa</small>#', $result );

		# empty string
		$options = [
			'copyright'  => '',
			'theme_info' => true,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertEmpty( $result );

		# null
		$options = [
			'copyright'  => null,
			'theme_info' => true,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertEmpty( $result );

		# option nothing, merge default settings
		$options = [
			'theme_info' => true,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertRegExp( '#<small>Copyright &copy; <strong>Test Blog</strong>, All rights reserved.</small>#', $result );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function render() {
		ob_start();
		$this->copyright->render();
		$result = ob_get_clean();

		$this->assertRegExp( '#<small>Copyright &copy; <strong>Test Blog</strong>, All rights reserved.</small>#', $result );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function has_theme_info() {
		# dafault is true
		$this->assertTrue( $this->copyright->has_theme_info() );

		# false
		$options = [
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => false,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# empty string
		$options = [
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => '',
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# null
		$options = [
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => null,
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# option nothing, merge default settings
		$options = [
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
		];
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertTrue( $this->copyright->has_theme_info() );
	}
}
