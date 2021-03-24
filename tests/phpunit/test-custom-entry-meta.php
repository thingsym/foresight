<?php
/**
 * Class Test_Custom_Entry_Meta
 *
 * @package Custom_Entry_Meta
 */

class Test_Custom_Entry_Meta extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->custom_entry_meta = new \Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta();
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->custom_entry_meta, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function get_entry_meta_options() {
		$options = $this->custom_entry_meta->get_entry_meta_options();
		$this->assertTrue( is_array( $options ) );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function render() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function posted_on() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function modified_on() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function posted_by() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function category() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function tag() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function comment() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function edit_post_link() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
