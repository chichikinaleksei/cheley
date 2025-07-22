<?php
/**
 * Theme shortcodes
 *
 * Please follow the same format for registering new shortcodes.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

namespace BaseTheme\Shortcodes;

/**
 * Button shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function button( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'href'      => '#',
			'style'     => 'primary',
			'color'     => 'normal',
			'alignment' => 'left',
			'target'    => '_self',
			'icon'      => '',
		),
		$atts
	);

	$href      = $atts['href'];
	$style     = $atts['style'];
	$color     = $atts['color'];
	$alignment = $atts['alignment'];
	$target    = $atts['target'];
	$icon      = $atts['icon'];

	$class  = 'c-btn c-btn-' . $style . ' c-btn-color-' . $color;
	$i      = null;
	$target = '';

	if ( '_blank' === $target ) {
		$target_link = "target=$target rel='noopener'";
	} else {
		$target_link = "target=$target";
	}

	if ( ! empty( $icon ) ) {
		$class .= " c-btn-icon-$icon";
		$i      = "<i class='icon-arrow-forward'></i>";
	}

	return "<div class='c-btn-wrapper text-$alignment'><a href='$href' class='$class' $target_link><span class='c-btn-text'>$content</span>$i</a></div>";
}
add_shortcode( 'button', 'BaseTheme\Shortcodes\button' );

/**
 * Group Buttons shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function group_buttons( $atts, $content ) {
	return "<div class='c-btn-group'>" . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'group_buttons', 'BaseTheme\Shortcodes\group_buttons' );

/**
 * Blockquote shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function blockquote( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'author' => '',
		),
		$atts
	);

	return '<blockquote class="alternate"><cite>' . $content . '</cite><span class="author">' . $atts['author'] . '</span></blockquote>';
}
add_shortcode( 'blockquote', 'BaseTheme\Shortcodes\blockquote' );

/**
 * Lead Paragraph shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function leadparagraph( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'alignment' => '',
			'letter'    => '',
		),
		$atts
	);

	$align = $atts['alignment'];

	if ( ! empty( $align ) ) {
		$align = ' text-' . $align;
	}

	if ( isset( $atts['letter'] ) && 'true' === $atts['letter'] ) {
		$first_letter = ' first-letter-large';
	} else {
		$first_letter = '';
	}

	return '<p class="leadparagraph' . $align . $first_letter . '">' . $content . '</p>';
}
add_shortcode( 'leadparagraph', 'BaseTheme\Shortcodes\leadparagraph' );

/**
 * Highlight Text shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function highlight( $atts, $content = null ) {
	shortcode_atts(
		array(),
		$atts
	);

	return '<span class="highlight-text">' . $content . '</span>';
}
add_shortcode( 'highlight', 'BaseTheme\Shortcodes\highlight' );

/**
 * Dropcap shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function dropcap_func( $atts, $content = null ) {
	shortcode_atts(
		array(),
		$atts
	);

	return '<span class="dropcap">' . $content . '</span>';
}
add_shortcode( 'dropcap', 'BaseTheme\Shortcodes\dropcap' );

/**
 * Hook (Anchor) shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function hook( $atts, $content = null ) {
	shortcode_atts(
		array(
			'id' => '#id',
		),
		$atts
	);

	return '<div id="' . $atts['id'] . '"></div>';
}
add_shortcode( 'hook', 'BaseTheme\Shortcodes\hook' );

/**
 * Content Images shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function content_image( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'align'   => 'none',
			'spacing' => 'normal',
		),
		$atts
	);

	$align   = $atts['align'];
	$spacing = $atts['spacing'];

	$images_class = 'content-image content-image__align-' . $align . ' spacing-' . $spacing;
	$images_count = substr_count( $content, '<img' );
	if ( $images_count > 1 ) {
		$images_class .= ' content-image-multiple';
	}
	return '<div class="' . $images_class . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'content_image', 'BaseTheme\Shortcodes\content_image' );

/**
 * Full width image shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function full_width_image( $atts, $content ) {
	ob_start();
	?>

	<section class="page-fullwidth-image">
		<figure class="page-fullwidth-image__wrapper">
			<?php echo do_shortcode( $content ); ?>
			<div class="page-fullwidth-image__bg"></div>
		</figure>
	</section>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'full_width_image', 'BaseTheme\Shortcodes\full_width_image' );

/**
 * Accordion Wrapper shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function accordion_wrapper( $atts, $content ) {
	ob_start();
	?>

	<section class="page-accordion">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 col-lg-10 col-xl-8 mx-auto">
					<?php echo do_shortcode( $content ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'accordion_wrapper', 'BaseTheme\Shortcodes\accordion_wrapper' );

/**
 * Accordion (Bellow) shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function accordion( $atts, $content ) {
	$acc_class = 'bellow';
	$acc_style = '';
	if ( 'open' === $atts['state'] ) {
		$acc_class .= ' active';
		$acc_style  = 'display:block;';
	}

	ob_start();
	?>

	<div class="<?php esc_attr_e( $acc_class ); ?>">
		<div class="bellow__title"><h3 class="h4"><?php esc_html_e( $atts['title'] ); ?></h3></div>
		<div class="bellow__content" style="<?php esc_attr_e( $acc_style ); ?>"><?php echo do_shortcode( $content ); ?></div>
	</div>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'accordion', 'BaseTheme\Shortcodes\accordion' );

/**
 * Columns shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function columns( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'desktop' => '10',
			'tablet'  => '10',
			'mobile'  => '12',
		),
		$atts
	);

	$cols_desktop_class = 'col-lg-' . $atts['desktop'];
	$cols_tablet_class  = 'col-md-' . $atts['tablet'];
	$cols_mobile_class  = 'col-' . $atts['mobile'];
	$cols_class         = $cols_mobile_class . ' ' . $cols_tablet_class . ' ' . $cols_desktop_class;
	$block_class[]      = 'page-columns';
	if ( isset( $atts['spacingtop'] ) && 'true' === $atts['spacingtop'] ) {
		$block_class[] = 'columns-spacing-top';
	}
	if ( isset( $atts['spacingbottom'] ) && 'true' === $atts['spacingbottom'] ) {
		$block_class[] = 'columns-spacing-bottom';
	}

	ob_start();
	?>

	<section class="<?php esc_attr_e( implode( ' ', $block_class ) ); ?>">
		<div class="container">
			<div class="row justify-content-center">
				<div class="<?php esc_attr_e( $cols_class ); ?>"><?php echo do_shortcode( $content ); ?></div></div>
		</div>
	</section>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'columns', 'BaseTheme\Shortcodes\columns' );

/**
 * Current year shortcode.
 *
 * @param array $atts The shortcodes attributes.
 */
function current_year( $atts ) {
	return gmdate( 'Y' );
}
add_shortcode( 'current_year', 'BaseTheme\Shortcodes\current_year' );

/**
 * Clear (clearfix) shortcode.
 */
function clear() {
	return '<div class="clearfix"></div>';
}
add_shortcode( 'clear', 'BaseTheme\Shortcodes\clear' );

/**
 * Tabs shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function tabs( $atts, $content = null ) {
	shortcode_atts( array( 'titles' => '' ), $atts );

	$titles = explode( ',', $atts['titles'] );
	$count  = count( $titles );
	$html   = '<div class="tabs">';

	$html .= '<ul>';
	for ( $i = 1; $i <= $count; $i++ ) {
		$html .= '<li><a href="#tabs-' . $i . '" rel="tabs-' . $i . '">' . trim( $titles[ $i ] ) . '</a></li>';
	}

	$html .= '</ul>';
	$html .= do_shortcode( $content );
	$html .= '</div>';

	return $html;
}
add_shortcode( 'tabs', 'BaseTheme\Shortcodes\tabs' );

/**
 * Tab shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function tab_func( $atts, $content = null ) {
	shortcode_atts(
		array(
			'id' => '',
		),
		$atts
	);

	$html  = '<div id="tabs-' . $atts['id'] . '">';
	$html .= do_shortcode( $content );
	$html .= '</div>';

	return $html;
}
add_shortcode( 'tab', 'BaseTheme\Shortcodes\tab' );

/**
 * Unordered list shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function unordered_list( $atts, $content ) {
	shortcode_atts(
		array(
			'type' => 'checklist',
		),
		$atts
	);
	$type = 'bullet' === $atts['type'] ? 'is-style-custom-bullet is-style-default' : 'is-style-check-icon';

	$html = preg_replace( '/<ul/', '<ul class="' . $type . '"', $content );

	return do_shortcode( $html );
}

add_shortcode( 'unordered_list', 'BaseTheme\Shortcodes\unordered_list' );

/**
 * Preheading shortcode.
 *
 * @param array  $atts    The shortcodes attributes.
 * @param string $content The content between the opening and closing shortcode tag.
 */
function preheading( $atts, $content ) {
	shortcode_atts(
		array(
			'alignment' => 'left',
		),
		$atts
	);
	$align = $atts['alignment'];

	return "<p class='overline align-$align'>" . do_shortcode( $content ) . '</p>';
}

add_shortcode( 'preheading', 'BaseTheme\Shortcodes\preheading' );

