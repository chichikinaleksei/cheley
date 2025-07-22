<?php
/**
 * In-Page Navigation
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

global $blocks;


if ( has_blocks( get_the_content() ) ) :
	$blocks = parse_blocks( get_the_content() );
	if ( ! empty( $blocks ) ) :
		?>
		<section class="inpage-nav">
			<div class="container">
				<div class="inpage-nav__wrapper">
					<nav class="inpage-nav__nav">
						<ul class="inpage-nav__list">
					<?php
					foreach ( $blocks as $key => $block ) :
						$anchor_id   = isset( $block['attrs']['data']['scroll_id'] ) ? $block['attrs']['data']['scroll_id'] : '';
						$anchor_link = strtolower( str_replace( ' ', '-', $anchor_id ) );
						$string      = preg_replace( '/[^A-Za-z0-9\-]/', '', $anchor_link );
						$anchor_link = preg_replace( '/-+/', '-', $string );
						if ( $anchor_id ) :
							?>
							<li class="inpage-nav__list-item">
								<a href="#<?php echo esc_attr( $anchor_link ); ?>" class="inpage-nav__item"><?php echo esc_html( $anchor_id ); ?></a>
							</li>
								<?php
							endif;
						endforeach;
					?>
						</ul>
					</nav>
				</div>
			</div>
		</section>
			<?php
		endif;
	endif;
