<?php
/**
 * The footer social part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$social = get_field( 'f_social', 'options' );
if ( ! empty( $social ) ) :
	?>
	<div class="main-footer__social">
		<?php
		foreach ( $social as $key => $icon ) :
			$icon_link = $icon['link'];
			$icon_logo = $icon['icon'];
			?>
			<div class="main-footer__social-item">
				<a href="<?php echo esc_url( $icon_link['url'] ); ?>"<?php echo ! empty( $icon_link['target'] ) ? ' target="' . esc_attr( $icon_link['target'] ) . '" rel="noopener"' : ''; ?> aria-label="<?php echo esc_attr( ucwords( str_replace( '-', ' ', $icon_logo ) ) ); ?>"><span class="<?php echo esc_attr( $icon_logo ); ?>"></span></a>
			</div>
			<?php
		endforeach;
		?>
	</div>
	<?php
endif;

