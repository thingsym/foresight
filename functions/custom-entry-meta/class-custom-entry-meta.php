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
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $section_id
	 */
	public $section_id = 'foresight_entry_meta';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $options_name
	 */
	public $options_name = 'foresight_entry_meta_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var int $section_priority
	 */
	public $section_priority = 20;

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $capability
	 */
	public $capability = 'edit_theme_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $default_options
	 */
	public $default_options = [
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

		$default_options = $this->default_options;
		$options         = null;

		if ( $type == 'option' ) {
			$options = get_option( $this->options_name, $default_options );
		}
		else if ( $type == 'theme_mod' ) {
			$options = get_theme_mod( $this->options_name, $default_options );
		}

		$options = array_merge( $default_options, $options );

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
			return apply_filters( 'foresight/functions/custom_entry_meta/get_options', $options, $type, $default_options );
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
			return apply_filters( 'foresight/functions/custom_entry_meta/get_option', $options[ $option_name ], $option_name, $type, $default_options );
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
				echo $this->category( $post_type, $taxonomy );
			}
			elseif ( 'tag' == $label ) {
				echo $this->tag( $post_type, $taxonomy );
			}
			elseif ( 'comment' == $label ) {
				$this->comment();
			}
			elseif ( 'editpost' == $label ) {
				echo $this->edit_post_link();
			}
		}
	}

	public function has_style() {
		return $this->get_options( 'style' );
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

		$meta_label = $this->has_style() ? '<span class="meta-label">' . __( 'Posted on', 'foresight' ) . ' </span>' : '';
		$posted_on = $meta_label . $time_string;

		return '<span class="posted-on"><i class="fas fa-clock"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
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

		$meta_label = $this->has_style() ? '<span class="meta-label">' . __( 'Modified on', 'foresight' ) . ' </span>' : '';
		$modified_on = $meta_label . $time_string;

		return '<span class="modified-on"><i class="fas fa-history"></i>' . $modified_on . '</span>'; // WPCS: XSS OK.
	}

	public function posted_by() {
		$meta_label = $this->has_style() ? '<span class="meta-label">' . __( 'by', 'foresight' ) . ' </span>' : '';
		$byline = $meta_label . '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		return '<span class="byline"><i class="fas fa-user-alt"></i>' . $byline . '</span>'; // WPCS: XSS OK.
	}

	public function category( $post_type = null, $taxonomy = null ) {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list ) {
				$meta_label = $this->has_style() ? '<span class="meta-label">' . __( 'Posted in', 'foresight' ) . ' </span>' : '';
				$category = $meta_label . $categories_list;

				return '<span class="cat-links"><i class="fas fa-folder-open"></i>' . $category . '</span>'; // WPCS: XSS OK.
			}
		}
		else {
			do_action( 'foresight/functions/entry_meta/custom_post_type/category' );
		}
	}

	public function tag( $post_type = null, $taxonomy = null ) {
		if ( 'post' === get_post_type() ) {
			$tags_list = get_the_tag_list( '', ' ' );
			if ( $tags_list ) {
				$meta_label = $this->has_style() ? '<span class="meta-label">' . __( 'Tagged', 'foresight' ) . ' </span>' : '';
				$tag = $meta_label . $tags_list;

				return '<span class="tags-links"><i class="fas fa-tags"></i>' . $tag . '</span>'; // WPCS: XSS OK.
			}
		}
		else {
			do_action( 'foresight/functions/entry_meta/custom_post_type/tag' );
		}
	}

	public function comment() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fas fa-comments"></i>';
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
			echo '</span>';
		}
	}

	public function edit_post_link() {
		$edit_post_link = get_edit_post_link();

		if ( ! $edit_post_link) {
			return;
		}

		$text = sprintf(
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
		);

		$link = '<a class="post-edit-link" href="' . esc_url( $edit_post_link ) . '">' . $text . '</a>';

		return '<span class="edit-link"><i class="fas fa-edit"></i>' . $link . '</span>';
	}

	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->default_options;

		$wp_customize->add_section(
			$this->section_id,
			[
				'title'      => __( 'Entry Meta', 'foresight' ),
				'priority'   => $this->section_priority,
				'panel'      => 'layout',
				'capability' => $this->capability,
			]
		);

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

		$wp_customize->add_setting(
			'foresight_entry_meta_options[style]',
			[
				'default'           => true,
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_entry_meta_options[style]',
			[
				'label'   => __( 'Display label', 'foresight' ),
				'section'    => $this->section_id,
				'type'    => 'checkbox',
			]
		);

	}
}
