<?php
/**
 * Class Test_Post_Thumbnail
 *
 * @package Post_Thumbnail
 */

use Foresight\Functions\Post_Thumbnail\Post_Thumbnail;

class Test_Post_Thumbnail extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
	}

	/**
	 * @test
	 * @group Post_Thumbnail
	 */
	public function public_variable() {
		$expected = [
			'thumbnail' => [
				'width'  => 150,
				'height' => 150,
			],
			'medium' => [
				'width'  => 300,
				'height' => 300,
			],
			'medium_large' => [
				'width'  => 768,
				'height' => 768,
			],
			'large' => [
				'width'  => 1028,
				'height' => 1028,
			],
			'full' => [
				'width'  => null,
				'height' => null,
			],
		];
		;
		$this->assertSame( $expected, Post_Thumbnail::$thumbnail_size );
	}

	/**
	 * @test
	 * @group Post_Thumbnail
	 */
	public function alternative_post_thumbnail() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Post_Thumbnail
	 */
	public function post_thumbnail() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Post_Thumbnail
	 */
	public function post_thumbnail_background_style() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
