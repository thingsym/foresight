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
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->copyright, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
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
		$options = array(
			'copyright'  => 'aaa',
			'theme_info' => true,
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertRegExp( '#<small>aaa</small>#', $result );

		# empty string
		$options = array(
			'copyright'  => '',
			'theme_info' => true,
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertEmpty( $result );

		# null
		$options = array(
			'copyright'  => null,
			'theme_info' => true,
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$result = $this->copyright->get_html();
		$this->assertEmpty( $result );

		# option nothing, merge default settings
		$options = array(
			'theme_info' => true,
		);
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
		$options = array(
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => false,
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# empty string
		$options = array(
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => '',
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# null
		$options = array(
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
			'theme_info' => null,
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# option nothing, merge default settings
		$options = array(
			'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
		);
		set_theme_mod( 'foresight_copyright_options', $options );

		$this->assertTrue( $this->copyright->has_theme_info() );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
