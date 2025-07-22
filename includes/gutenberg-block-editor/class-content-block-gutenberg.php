<?php
/**
 * The Content Block Class.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Content Block Gutenberg
 *
 * A class for easily retrieving information related to our various content sections now powered by Gutenberg ACF blocks.
 */
class Content_Block_Gutenberg {
	/**
	 * The block data.
	 *
	 * @var array
	 */
	private $block;

	/**
	 * Constructor.
	 *
	 * Sets up the block.
	 *
	 * @param array $block The block data.
	 */
	public function __construct( $block ) {
		$this->block = $block;
	}

	/**
	 * Get block spacing styles.
	 *
	 * Spacing styles are editable from the "Options" tab on the block in the block editor.
	 *
	 * @param string $output The empty spacing styles for the block.
	 * @return string        The completed styles.
	 */
	public function get_block_spacing( $output = '' ) {
		$spacing = get_field( 'spacing' );

		$block_id = '#' . self::get_block_id();
		$desktop  = '';
		$tablet   = '';
		$mobile   = '';

		if ( ! empty( $spacing['custom_margins'] ) ) {
			$output = '<style>';

			if ( isset( $spacing['desktop'] ) ) {
				$desktop .= 'margin-bottom:' . rem_calc( $spacing['desktop'] ) . '!important;';
			}
			if ( isset( $spacing['tablet'] ) ) {
				$tablet .= 'margin-bottom:' . rem_calc( $spacing['tablet'] ) . '!important;';
			}
			if ( isset( $spacing['mobile'] ) ) {
				$mobile .= 'margin-bottom:' . rem_calc( $spacing['mobile'] ) . '!important;';
			}

			if ( ! empty( $desktop ) ) {
				$output .= $block_id . '{' . $desktop . '}';
			}

			$tablet_size = get_theme_setting( 'tablet_breakpoint' );
			if ( ! empty( $tablet ) && $tablet_size ) {
				$output .= '@media (max-width: ' . $tablet_size . 'px) {' . $block_id . '{' . $tablet . '}}';
			}

			$mobile_size = get_theme_setting( 'mobile_breakpoint' );
			if ( ! empty( $mobile ) && $mobile_size ) {
				$output .= '@media (max-width: ' . $mobile_size . 'px) {' . $block_id . '{' . $mobile . '}}';
			}

			$output .= '</style>';
		}

		return $output;
	}

	/**
	 * Get ACF link display.
	 *
	 * @param  string $link        ACF link field.
	 * @param  string $classes     Classes to be applied to the link.
	 * @param  bool   $use_wrapper Whether to use the button wrapper or not.
	 * @return string              HTML link.
	 */
	public static function acf_link( $link, $classes = 'c-btn', $use_wrapper = true ) {

		$output = '';
		if ( ! empty( $link['title'] ) && ! empty( $link['url'] ) ) {
			$output .= $use_wrapper ? '<div class="c-btn-wrapper">' : '';
			$output .= '<a href="' . $link['url'] . '" class="' . $classes . '"';
			$output .= ( ! empty( $link['target'] ) ) ? ' target="' . $link['target'] . '"' : '';
			$output .= '><span class="c-btn-text">' . $link['title'] . '</span></a>';
			$output .= $use_wrapper ? '</div>' : '';
		}

		return $output;
	}

	/**
	 * Display the blocks section title.
	 */
	public function the_block_title() {
		$block_title = get_field( 'section_title' );
		if ( ! empty( $block_title ) ) :
			echo esc_html_e( $block_title );
		endif;
	}

	/**
	 * Get Block ID.
	 *
	 * @return string ID friendly title.
	 */
	public function get_block_id() : string {
		$scroll_id = get_field( 'scroll_id' );
		$block_id  = ! empty( $scroll_id )
			? sanitize_title( $scroll_id )
			: 'page-block-' . $this->block['id'];

		return $block_id;
	}

	/**
	 * Get Block ID with attribute definition.
	 *
	 * @return string ID friendly title.
	 */
	public function get_block_id_attr() : string {
		return 'id="' . self::get_block_id() . '"';
	}

	/**
	 * Get bootstrap column classes from an array of breakpoints.
	 *
	 * @param array $sizes    Sizes to get classes for.
	 * @param array $defaults The default sizes.
	 */
	public function get_column_classes( array $sizes, array $defaults = array() ) : string {
		$classes = array_map(
			function( $viewport, $size ) use ( $defaults ) {
				if ( empty( $size ) && isset( $defaults[ $viewport ] ) ) {
					$size = $defaults[ $viewport ];
				}

				if ( 'mobile' === $viewport ) {
					$viewport = 'sm';
				} elseif ( 'tablet' === $viewport ) {
					$viewport = 'md';
				} elseif ( 'desktop' === $viewport ) {
					$viewport = 'lg';
				}

				return "col-$viewport-$size";
			},
			array_keys( $sizes ),
			$sizes
		);

		return 'col-12 ' . implode( ' ', $classes );
	}
}
