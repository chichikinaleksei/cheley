<?php
/**
 * Video Background Template
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

if ( isset( $video ) ) {
		$class          = isset( $class ) ? ' ' . $class : '';
		$pattern_yt     = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";
		$pattern_vimeo  = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/';
		$pattern_wistia = '/https?:\/\/[^.]+\.(wistia\.com|wistia\.net|wi\.st)\/(medias|embed)\/.*/';

		$embed = wp_oembed_get( $video );
		preg_match( '/src="(.+?)"/', $embed, $matches );
		$video_src = $matches[1];


		$is_yt     = preg_match( $pattern_yt, $video_src, $yt_match );
		$is_wistia = preg_match( $pattern_wistia, $video_src );
		$is_vimeo  = preg_match( $pattern_vimeo, $video_src );


	if ( $is_wistia || $is_vimeo ) {
		if ( $is_wistia ) {
			$params[] = array(
				'volume'                 => 0,
				'endVideoBehavior'       => 'loop',
				'autoplay'               => 1,
				'muted'                  => 1,
				'volumecontrol'          => 0,
				'playSuspendedOffScreen' => false,
			);
		} else {
			$params[] = array(
				'autoplay'  => 1,
				'muted'     => 1,
				'loop'      => 1,
				'controls'  => 0,
				'autopause' => 0,
			);
		}

		$attr  = 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen';
		$src   = add_query_arg( $params, $video_src );
		$video = str_replace( $video_src, $src, $embed );
		$video = str_replace( '></iframe>', ' ' . $attr . '></iframe>', $video );
	} else {
		$video = null;
	}
}
?>
	<div class="video-bg<?php echo esc_attr( $class ); ?>">
	<?php if ( $is_yt ) : ?>
		<div class="yt-player" id="yt-player-<?php echo wp_kses_post( $yt_match[1] ); ?>" data-id="<?php echo wp_kses_post( $yt_match[1] ); ?>"></div>
	<?php else : ?>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $video;
		?>
	<?php endif; ?>
	</div>
