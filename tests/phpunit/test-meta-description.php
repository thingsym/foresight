<?php
/**
 * Class Test_Meta_Description
 *
 * @package Meta_Description
 */

class Test_Meta_Description extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->meta_description = new \Foresight\Functions\SEO\Meta_Description();
	}

	/**
	 * @test
	 * @group Meta_Description
	 */
	public function constructor() {
		$this->assertSame( 1, has_filter( 'wp_head', [ $this->meta_description, 'print_tag' ] ) );
	}

	/**
	 * @test
	 * @group Meta_Description
	 */
	public function get_description() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Meta_Description
	 */
	public function trim_description() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Meta_Description
	 */
	public function print_tag() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
