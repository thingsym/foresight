<?php
/**
 * Custom Entry Meta
 *
 * @package Foresight
 * @since 1.2.0
 */

namespace Foresight\Functions\Custom_Entry_Meta;

use Foresight\Functions\Customizer\Customize_Control\Sortable_Options;

/**
 * Class Custom_Entry_Meta
 *
 * @since 1.2.0
 */
class Custom_Entry_Meta {

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $section_id
	 */
	protected $section_id = 'foresight_entry_meta';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $options_name
	 */
	protected $options_name = 'foresight_entry_meta_options';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var int $section_priority
	 */
	protected $section_priority = 20;

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $capability
	 */
	protected $capability = 'manage_options';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var array $default_options
	 */
	protected $default_options = [
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
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
	}

	/**
	 * Returns the options array or value.
	 *
	 * @access public
	 *
	 * @param string $option_name  The option name or modification name via argument.
	 * @param string $type         The option or theme_mod.
	 *
	 * @return mixed|null
	 *
	 * @since 1.0.0
	 */
	public function get_options( $option_name = null, $type = 'theme_mod' ) {
		if ( ! $type ) {
			return null;
		}

		$options = null;

		if ( $type == 'option' ) {
			$options = get_option( $this->options_name, $this->default_options );
		}
		else if ( $type == 'theme_mod' ) {
			$options = get_theme_mod( $this->options_name, $this->default_options );
		}

		$options = array_merge( $this->default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param mixed     $options     The option values or modification values.
			 * @param string    $type        The option or theme_mod.
			 * @param mixed     $default     Default value to return if the option does not exist.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/custom_entry_meta/get_options', $options, $type, $this->default_options );
		}

		if ( array_key_exists( $option_name, $options ) ) {
			/**
			 * Filters the option.
			 *
			 * @param mixed     $option          The option value or modification value.
			 * @param string    $option_name     The option name or modification name via argument.
			 * @param string    $type            The option or theme_mod.
			 * @param mixed     $default         Default value to return if the option does not exist.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/custom_entry_meta/get_option', $options[ $option_name ], $option_name, $type, $this->default_options );
		}
		else {
			return null;
		}
	}

	public function get_entry_meta_options() {
		$entry_meta_options = [
			'postdate'     => __( 'Post Date', 'foresight' ),
			'modifieddate' => __( 'Modified Date', 'foresight' ),
			'author'       => __( 'Author', 'foresight' ),
			'category'     => __( 'Category', 'foresight' ),
			'tag'          => __( 'Tag', 'foresight' ),
			'comment'      => __( 'Comment', 'foresight' ),
			'editpost'     => __( 'Edit Post Link', 'foresight' ),
		];

		return $entry_meta_options;
	}

	public function render( $meta = null, $post_type = null, $taxonomy = null ) {
		if ( ! $meta ) {
			return;
		}

		if ( 'header' == $meta ) {
			$meta = (array) $this->get_options( 'header' );
		}
		elseif ( 'footer' == $meta ) {
			$meta = (array) $this->get_options( 'footer' );
		}

		foreach ( $meta as $label ) {
			if ( 'postdate' == $label ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->posted_on();
			}
			elseif ( 'modifieddate' == $label ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->modified_on();
			}
			elseif ( 'author' == $label ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->posted_by();
			}
			elseif ( 'category' == $label ) {
				$this->category( $post_type, $taxonomy );
			}
			elseif ( 'tag' == $label ) {
				$this->tag( $post_type, $taxonomy );
			}
			elseif ( 'comment' == $label ) {
				$this->comment();
			}
			elseif ( 'editpost' == $label ) {
				$this->edit_post_link();
			}
		}
	}

	public function posted_on() {
		if ( empty( get_option( 'date_format' ) ) ) {
			return;
		}

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s %3$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_html( get_the_time() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'foresight' ),
			$time_string
		);

		return '<span class="posted-on"><i class="fas fa-clock"></i> ' . $posted_on . '</span> '; // WPCS: XSS OK.
	}

	public function modified_on() {
		if ( empty( get_option( 'date_format' ) ) ) {
			return;
		}

		if ( get_the_modified_time( 'U' ) <= get_the_time( 'U' ) ) {
			return;
		}

		$time_string = '<time class="entry-date modified" datetime="%1$s">%2$s %3$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() ),
			esc_html( get_the_modified_time() )
		);

		$modified_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Modified on %s', 'post date', 'foresight' ),
			$time_string
		);

		return '<span class="modified-on"><i class="fas fa-history"></i> ' . $modified_on . '</span> '; // WPCS: XSS OK.
	}

	public function posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'foresight' ),
			// @phpstan-ignore-next-line
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		return '<span class="byline"><i class="fas fa-user-alt"></i> ' . $byline . '</span> '; // WPCS: XSS OK.
	}

	public function category( $post_type = null, $taxonomy = null ) {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'foresight' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="fas fa-folder-open"></i> ' . esc_html__( 'Posted in %1$s', 'foresight' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				echo ' ';
			}
		}
		else {
			do_action( 'foresight/functions/entry_meta/custom_post_type/category' );
		}
	}

	public function tag( $post_type = null, $taxonomy = null ) {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'foresight' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i> ' . esc_html__( 'Tagged %1$s', 'foresight' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				echo ' ';
			}
		}
		else {
			do_action( 'foresight/functions/entry_meta/custom_post_type/tag' );
		}
	}

	public function comment() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fas fa-comments"></i> ';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'foresight' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				)
			);
			echo '</span> ';
		}
	}

	public function edit_post_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit<span class="screen-reader-text"> %s</span>', 'foresight' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-edit"></i> ',
			'</span>'
		);
	}

	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$wp_customize->add_section(
			$this->section_id,
			[
				'title'    => __( 'Entry Meta', 'foresight' ),
				'priority' => $this->section_priority,
				'panel'    => 'layout',
			]
		);

		$default_options = $this->default_options;

		$wp_customize->add_setting(
			'foresight_entry_meta_options[header]',
			[
				'default'           => $default_options['header'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Customize_Control\Sortable_Options', 'sanitize_options' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Sortable_Options(
				$wp_customize,
				'foresight_entry_meta_options[header]',
				[
					'label'      => __( 'Header', 'foresight' ),
					'section'    => $this->section_id,
					'type'       => 'sortable_multiple_checkbox',
					'options'    => $this->get_entry_meta_options(),
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_entry_meta_options[footer]',
			[
				'default'           => $default_options['footer'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Customize_Control\Sortable_Options', 'sanitize_options' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Sortable_Options(
				$wp_customize,
				'foresight_entry_meta_options[footer]',
				[
					'label'      => __( 'Footer', 'foresight' ),
					'section'    => $this->section_id,
					'type'       => 'sortable_multiple_checkbox',
					'options'    => $this->get_entry_meta_options(),
				]
			)
		);
	}
}
