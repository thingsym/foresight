<?php
/**
 * Class Test_Custom_Entry_Meta
 *
 * @package Custom_Entry_Meta
 */

class Test_Custom_Entry_Meta extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->custom_entry_meta = new \Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta();
	}

	public function tearDown(): void {
		remove_theme_mod( $this->custom_entry_meta->options_name );
		remove_filter( 'foresight/functions/custom_entry_meta/get_option', array( $this, '_filter_option' ) );
		remove_filter( 'foresight/functions/custom_entry_meta/get_options', array( $this, '_filter_options' ) );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->custom_entry_meta );
		$this->assertObjectHasAttribute( 'options_name', $this->custom_entry_meta );
		$this->assertObjectHasAttribute( 'section_priority', $this->custom_entry_meta );
		$this->assertObjectHasAttribute( 'capability', $this->custom_entry_meta );
		$this->assertObjectHasAttribute( 'default_options', $this->custom_entry_meta );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_entry_meta', $this->custom_entry_meta->section_id );
		$this->assertSame( 'foresight_entry_meta_options', $this->custom_entry_meta->options_name );
		$this->assertSame( 20, $this->custom_entry_meta->section_priority );
		$this->assertSame( 'edit_theme_options', $this->custom_entry_meta->capability );

		$expected = [
			'header' => [
				'postdate',
				'modifieddate',
				'author',
			],
			'footer' => [
				'category',
				'tag',
				'comment',
				'editpost',
			],
			'style' => true,
		];
		$this->assertSame( $expected, $this->custom_entry_meta->default_options );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->custom_entry_meta, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function get_options() {
		$this->assertNull( $this->custom_entry_meta->get_options( null, null ) );

		$expected = [
			'header' => [
				'postdate',
				'modifieddate',
				'author',
			],
			'footer' => [
				'category',
				'tag',
				'comment',
				'editpost',
			],
			'style' => true,
		];
		$this->assertSame( $expected, $this->custom_entry_meta->get_options() );

		$options = [
			'header' => [
				'postdate',
				'comment',
				'editpost',
			],
			'footer' => [
				'category',
				'tag',
				'modifieddate',
				'author',
			],
			'style' => true,
		];
		set_theme_mod( $this->custom_entry_meta->options_name, $options );

		$expected = [
			'header' => [
				'postdate',
				'comment',
				'editpost',
			],
			'footer' => [
				'category',
				'tag',
				'modifieddate',
				'author',
			],
			'style' => true,
		];
		$this->assertSame( $expected, $this->custom_entry_meta->get_options() );
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
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->posted_on();

		$datetime = new DateTime( $args[ 'post_date' ] );
		$format = $datetime->format('c');

		$this->assertRegExp( '/' . preg_quote( $format ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function modified_on() {
		$args = array(
			'post_title' => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_date' => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->modified_on();
		$this->assertNull( $result );

		// $args = array(
		// 	'ID'            => $post_id,
		// 	'post_title'    => 'edited',
		// 	'post_content'  => 'abc',
		// 	'post_modified' => '2022-11-11 11:11:11',
		// );

		// $post_id = wp_update_post( $args );

		// $post = get_post( $post_id );
		// setup_postdata( $post );

		// $result = $this->custom_entry_meta->modified_on();

		// $datetime = new DateTime( $args[ 'post_modified' ] );
		// $format = $datetime->format('c');

		// $this->assertRegExp( '/' . preg_quote( $format ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function posted_by() {
		$user_id = $this->factory->user->create( ['role' => 'editor'] );
		$user = wp_set_current_user( $user_id );

		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->posted_by();

		$this->assertRegExp( '/' . preg_quote( $user->user_login ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function category() {
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->category();
		$this->assertRegExp( '/' . preg_quote( 'Uncategorized' ) . '/', $result );

		$post_category[] = $this->factory->category->create( [ 'name' => 'Sample Category 1' ] );

		$args = array(
			'post_title'    => 'Hello World!',
			'post_content'  => 'Hello World!',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_date'     => '2022-10-09 00:00:00',
			'post_category' => $post_category,
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->category();

		$this->assertRegExp( '/' . preg_quote( 'Sample Category 1' ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function tag() {
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->tag();
		$this->assertNull( $result );

		$tags_input[] = $this->factory->term->create( [ 'name' => 'Sample Tag 1' ] );

		$args = array(
			'post_title'    => 'Hello World!',
			'post_content'  => 'Hello World!',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_date'     => '2022-10-09 00:00:00',
			'tags_input' => $tags_input,
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->tag();

		$this->assertRegExp( '/' . preg_quote( 'Sample Tag 1' ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function comment() {
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		ob_start();
		$result = $this->custom_entry_meta->comment();
		$result = ob_get_clean();

		$this->assertRegExp( '/' . preg_quote( 'Leave a Comment' ) . '/', $result );

		$post_id = $this->factory->post->create( $args );

		$this->factory->comment->create_and_get( [
			'comment_post_ID' => $post_id,
			'comment_author'  => 'test',
			'comment_content' => 'This is a comment',
		] );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		ob_start();
		$result = $this->custom_entry_meta->comment();
		$result = ob_get_clean();

		$this->assertRegExp( '/' . preg_quote( '1 Comment' ) . '/', $result );

		$post_id = $this->factory->post->create( $args );

		$comment = $this->factory->comment->create_many(
			5,
			[
				'comment_post_ID' => $post_id,
				'comment_author'  => 'test',
			]
		);

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		ob_start();
		$result = $this->custom_entry_meta->comment();
		$result = ob_get_clean();

		$this->assertRegExp( '/' . preg_quote( '5 Comment' ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function edit_post_link() {
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->edit_post_link();
		$this->assertNull( $result );

		$user = wp_set_current_user( 1 );
		$result = $this->custom_entry_meta->edit_post_link();

		$this->assertRegExp( '/' . preg_quote( 'action=edit' ) . '/', $result );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function has_style() {
		$result = $this->custom_entry_meta->has_style();
		$this->assertTrue( $result );

		$user_id = $this->factory->user->create( ['role' => 'editor'] );
		$user = wp_set_current_user( $user_id );

		$post_category[] = $this->factory->category->create( [ 'name' => 'Sample Category 1' ] );
		$tags_input[] = $this->factory->term->create( [ 'name' => 'Sample Tag 1' ] );

		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World!',
			'post_status'  => 'publish',
			'post_date'    => '2022-10-09 00:00:00',
			'post_category' => $post_category,
			'tags_input' => $tags_input,
		);

		$post_id = $this->factory->post->create( $args );

		$args = array(
			'ID'            => $post_id,
			'post_title'    => 'edited',
			'post_content'  => 'abc',
			'post_modified' => '2022-11-11 11:11:11',
		);

		$post_id = wp_update_post( $args );

		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );

		$result = $this->custom_entry_meta->posted_on();
		$this->assertRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->modified_on();
		$this->assertRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->posted_by();
		$this->assertRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->category();
		$this->assertRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->tag();
		$this->assertRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );

		$options = [
			'header' => [
				'postdate',
				'comment',
				'editpost',
			],
			'footer' => [
				'category',
				'tag',
				'modifieddate',
				'author',
			],
			'style' => false,
		];
		set_theme_mod( $this->custom_entry_meta->options_name, $options );

		$result = $this->custom_entry_meta->has_style();
		$this->assertFalse( $result );

		$result = $this->custom_entry_meta->posted_on();
		$this->assertNotRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->modified_on();
		$this->assertNotRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->posted_by();
		$this->assertNotRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->category();
		$this->assertNotRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
		$result = $this->custom_entry_meta->tag();
		$this->assertNotRegExp( '/' . preg_quote( 'meta-label' ) . '/', $result );
	}

}
